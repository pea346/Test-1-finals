<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ItemsModel;
use App\Models\OrdersModel;
use App\Models\UsersModel;

class ClientController extends BaseController
{
    protected $ordersModel;
    protected $itemsModel;
    protected $usersModel;

    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->itemsModel = new ItemsModel();
        $this->usersModel = new UsersModel();
    }

    // ---------------- Helper Methods ----------------

    private function checkUser()
    {
        $session = session();
        $user = $session->get('user');

        if (!$user) return redirect()->to('/login');
        return $user;
    }

    private function getUserId()
    {
        $user = $this->checkUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;
        return $user['id'];
    }

    private function generateOrderNumber($orderId)
    {
        return 'ORD' . str_pad($orderId, 5, '0', STR_PAD_LEFT);
    }

    private function getItemPrice($itemId)
    {
        $item = $this->itemsModel->find($itemId);
        return $item ? $item['cost'] : 0;
    }

    // ----------------- User / Account -----------------

    public function profile()
    {
        $userId = $this->getUserId();
        if ($userId instanceof \CodeIgniter\HTTP\RedirectResponse) return $userId;

        $user = $this->usersModel->find($userId);
        return view('client/profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        $userId = $this->getUserId();
        if ($userId instanceof \CodeIgniter\HTTP\RedirectResponse) return $userId;

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
        ];

        if (!$this->usersModel->update($userId, $data)) {
            return redirect()->back()->with('error', 'Update failed.')->withInput();
        }

        return redirect()->to('/client/profile')->with('success', 'Profile updated!');
    }

    public function deleteAccount()
    {
        $userId = $this->getUserId();
        if ($userId instanceof \CodeIgniter\HTTP\RedirectResponse) return $userId;

        $this->usersModel->update($userId, ['account_status' => 0]);
        session()->destroy();

        return redirect()->to('/login')->with('success', 'Your account has been deactivated.');
    }

    public function reactivateAccount()
    {
        $userId = $this->getUserId();
        if ($userId instanceof \CodeIgniter\HTTP\RedirectResponse) return $userId;

        $this->usersModel->update($userId, ['account_status' => 1]);
        return redirect()->to('/client/profile')->with('success', 'Your account has been reactivated!');
    }

    // ----------------- Menu / Items -----------------

    public function home()
    {
        $user = $this->checkUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        return view('client/home', ['user' => $user]);
    }

    public function menu()
    {
        $user = $this->checkUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $items = $this->itemsModel
            ->where('is_active', 1)
            ->where('is_available', 1)
            ->findAll();

        return view('client/menu', ['user' => $user, 'items' => $items]);
    }

    // ----------------- Orders -----------------

    public function orders()
    {
        $user = $this->checkUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $orders = $this->ordersModel
            ->select('orders.id, orders.order_number, orders.quantity, orders.status, orders.total_price, orders.created_at, items.title as item_name')
            ->join('items', 'items.id = orders.item_id')
            ->where('orders.user_id', $user['id'])
            ->where('orders.status', 'Pending')
            ->orderBy('orders.created_at', 'DESC')
            ->findAll();

        return view('client/orders', ['orders' => $orders]);
    }

    public function addToOrders()
    {
        $userId = $this->getUserId();
        if ($userId instanceof \CodeIgniter\HTTP\RedirectResponse) return $userId;

        $itemId = $this->request->getPost('item_id');
        $quantity = (int) $this->request->getPost('quantity');

        $existingOrder = $this->ordersModel->where([
            'user_id' => $userId,
            'item_id' => $itemId,
            'status'  => 'Pending'
        ])->first();

        if ($existingOrder) {
            $newQuantity = $existingOrder['quantity'] + $quantity;
            $this->ordersModel->update($existingOrder['id'], [
                'quantity' => $newQuantity,
                'total_price' => $newQuantity * $this->getItemPrice($itemId)
            ]);
        } else {
            $orderId = $this->ordersModel->insert([
                'user_id' => $userId,
                'item_id' => $itemId,
                'quantity' => $quantity,
                'total_price' => $quantity * $this->getItemPrice($itemId),
                'status' => 'Pending',
                'order_number' => null
            ]);

            $this->ordersModel->update($orderId, [
                'order_number' => $this->generateOrderNumber($orderId)
            ]);
        }

        return redirect()->back()->with('success', 'Order added successfully.');
    }

    public function completeOrder()
    {
        $userId = $this->getUserId();
        if ($userId instanceof \CodeIgniter\HTTP\RedirectResponse) return $userId;

        $itemId = $this->request->getPost('item_id');
        $quantity = (int)$this->request->getPost('quantity');

        $item = $this->itemsModel->find($itemId);
        if (!$item) return redirect()->back()->with('error', 'Item not found.');

        $orderId = $this->ordersModel->insert([
            'user_id'     => $userId,
            'item_id'     => $itemId,
            'quantity'    => $quantity,
            'total_price' => $item['cost'] * $quantity,
            'status'      => 'Completed',
            'order_number' => null,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $this->ordersModel->update($orderId, [
            'order_number' => $this->generateOrderNumber($orderId)
        ]);

        return redirect()->to('/client/orders')->with('success', 'Order completed!');
    }

    public function confirmOrders()
    {
        $userId = $this->getUserId();
        if ($userId instanceof \CodeIgniter\HTTP\RedirectResponse) return $userId;

        $this->ordersModel
            ->where('user_id', $userId)
            ->where('status', 'Pending')
            ->set(['status' => 'Completed'])
            ->update();

        return redirect()->to('/client/orders')->with('success', 'Your orders are now completed.');
    }

    public function cancelOrder($orderId)
    {
        $order = $this->ordersModel->find($orderId);
        if (!$order) return redirect()->back()->with('error', 'Order not found.');

        if ($order['status'] !== 'Pending') {
            return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
        }

        $this->ordersModel->update($orderId, ['status' => 'Cancelled']);
        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }
}
