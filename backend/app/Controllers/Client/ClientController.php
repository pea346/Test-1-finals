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
        $user = session()->get('user');
        if (!$user) return redirect()->to('/login');

        $itemId = $this->request->getPost('item_id');
        $quantity = (int) $this->request->getPost('quantity');

        $ordersModel = new \App\Models\OrdersModel();

        // Check if user already has a pending order for this item
        $existingOrder = $ordersModel
            ->where('user_id', $user['id'])
            ->where('item_id', $itemId)
            ->where('status', 'Pending')
            ->first();

        if ($existingOrder) {
            // Just increase quantity
            $newQty = $existingOrder['quantity'] + $quantity;
            $ordersModel->update($existingOrder['id'], [
                'quantity' => $newQty,
                'total_price' => $newQty * $existingOrder['total_price'] / $existingOrder['quantity'] // recalc total price
            ]);
        } else {
            // Insert new order
            $itemsModel = new \App\Models\ItemsModel();
            $item = $itemsModel->find($itemId);

            $ordersModel->insert([
                'user_id' => $user['id'],
                'item_id' => $itemId,
                'quantity' => $quantity,
                'total_price' => $quantity * $item['cost'],
                'status' => 'Pending',
                'order_number' => null   // IMPORTANT
            ]);
        }

        return redirect()->back()->with('success', 'Item added to your orders.');
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
        $user = $this->checkUser();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $order = $this->ordersModel->where('id', $orderId)->where('user_id', $user['id'])->first();
        if (!$order) return redirect()->back()->with('error', 'Order not found.');

        $this->ordersModel->delete($orderId);
        return redirect()->back()->with('success', 'Order canceled.');
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
}
