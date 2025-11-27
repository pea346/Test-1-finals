<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ItemsModel;
use App\Models\OrdersModel;

class ClientController extends BaseController
{
    protected $ordersModel;
    protected $itemsModel;

    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->itemsModel = new ItemsModel();
    }

    // Check if user is logged in
    private function checkUser()
    {
        $session = session();
        $user = $session->get('user');

        if (!$user) return redirect()->to('/login');
        return $user;
    }

    // Client home
    public function home()
    {
        $user = $this->checkUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        return view('client/home', ['user' => $user]);
    }

    // Client menu
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

    // Add to Orders (Pending)
    public function addToOrders()
    {
        $userId = session()->get('user')['id'];
        $itemId = $this->request->getPost('item_id');
        $quantity = (int) $this->request->getPost('quantity');

        $ordersModel = new \App\Models\OrdersModel();

        // Check if this item already exists in pending orders for this user
        $existingOrder = $ordersModel->where([
            'user_id' => $userId,
            'item_id' => $itemId,
            'status'  => 'Pending'
        ])->first();

        if ($existingOrder) {
            // Update quantity
            $newQuantity = $existingOrder['quantity'] + $quantity;
            $ordersModel->update($existingOrder['id'], [
                'quantity' => $newQuantity,
                'total_price' => $newQuantity * $this->getItemPrice($itemId)
            ]);
        } else {
            // Insert new order
            // Insert first without order_number
            $orderId = $ordersModel->insert([
                'user_id' => $userId,
                'item_id' => $itemId,
                'quantity' => $quantity,
                'total_price' => $quantity * $this->getItemPrice($itemId),
                'status' => 'Pending',
                'order_number' => null
            ]);

            // Generate sequential order number
            $orderNumber = 'ORD' . str_pad($orderId, 5, '0', STR_PAD_LEFT);
            $ordersModel->update($orderId, ['order_number' => $orderNumber]);
        }

        return redirect()->back()->with('success', 'Order added successfully.');
    }

    /**
     * Helper to get item price
     */
    private function getItemPrice($itemId)
    {
        $itemsModel = new \App\Models\ItemsModel();
        $item = $itemsModel->find($itemId);
        return $item ? $item['cost'] : 0;
    }


    // Complete Order (Order Now)
    public function completeOrder()
    {
        $user = session()->get('user');

        $item_id  = $this->request->getPost('item_id');
        $quantity = (int)$this->request->getPost('quantity');

        $item = $this->itemsModel->find($item_id);
        if (!$item) return redirect()->back()->with('error', 'Item not found.');

        $totalPrice = $item['cost'] * $quantity;

        $orderId = $this->ordersModel->insert([
            'user_id'     => $user['id'],
            'item_id'     => $item_id,
            'quantity'    => $quantity,
            'total_price' => $totalPrice,
            'status'      => 'Completed',
            'order_number' => null,      // IMPORTANT
            'created_at'  => date('Y-m-d H:i:s')
        ]);


        $orderNumber = 'ORD' . str_pad($orderId, 5, '0', STR_PAD_LEFT);
        $this->ordersModel->update($orderId, ['order_number' => $orderNumber]);

        return redirect()->to('/client/orders')->with('success', 'Order completed!');
    }





    // List all orders for the logged-in client
    public function orders()
    {
        $user = $this->checkUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        // Only show PENDING orders for the client
        $orders = $this->ordersModel
            ->select('orders.id, orders.order_number, orders.quantity, orders.status, orders.total_price, orders.created_at, items.title as item_name')
            ->join('items', 'items.id = orders.item_id')
            ->where('orders.user_id', $user['id'])
            ->where('orders.status', 'Pending') // <--- only pending
            ->orderBy('orders.created_at', 'DESC')
            ->findAll();

        return view('client/orders', ['orders' => $orders]);
    }


    // Cancel a pending order
    public function cancelOrder($orderId)
    {
        $ordersModel = new \App\Models\OrdersModel();
        $order = $ordersModel->find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Only allow cancelling pending orders
        if ($order['status'] !== 'Pending') {
            return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
        }

        $ordersModel->update($orderId, ['status' => 'Cancelled']);

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

    public function confirmOrders()
    {
        $user = $this->checkUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        // Complete all pending orders for this user
        $this->ordersModel
            ->where('user_id', $user['id'])
            ->where('status', 'Pending')
            ->set(['status' => 'Completed'])
            ->update();

        return redirect()->to('/client/orders')->with('success', 'Your orders are now completed.');
    }

    public function profile()
    {
        $session = session();
        $userId = $session->get('user')['id'] ?? null;

        if (!$userId) {
            return redirect()->to('/login');
        }

        $usersModel = new \App\Models\UsersModel();
        $user = $usersModel->find($userId); // ensures account_status is included

        return view('client/profile', ['user' => $user]);
    }

    public function deleteAccount()
    {
        $usersModel = new \App\Models\UsersModel();
        $userId = session()->get('user')['id']; // get logged-in user ID

        // Soft delete: mark account as inactive
        $usersModel->update($userId, ['account_status' => 0]);

        // Destroy session so user is logged out
        session()->destroy();

        return redirect()->to('/login')->with('success', 'Your account has been deactivated.');
    }
}
