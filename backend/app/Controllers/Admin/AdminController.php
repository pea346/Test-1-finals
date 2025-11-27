<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\ItemsModel;
use App\Models\OrdersModel;

class AdminController extends BaseController
{
    protected $ordersModel;
    protected $itemsModel;
    protected $usersModel;

    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->itemsModel  = new ItemsModel();
        $this->usersModel  = new UsersModel();
    }

    // ----------------- Helper -----------------
    private function checkManager()
    {
        $session = session();
        $user = $session->get('user');

        if (!$user) return redirect()->to('/login');
        if (strtolower($user['type']) !== 'manager') return redirect()->to('/no-access');

        return $user;
    }

    // ----------------- DASHBOARD -----------------
    public function index()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        return view('admin/dashboard', ['user' => $user]);
    }

    // ----------------- MENU -----------------
    public function menu()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $items = $this->itemsModel->findAll();

        return view('admin/menu', [
            'user' => $user,
            'items' => $items
        ]);
    }

    // ----------------- ACCOUNTS -----------------
    public function accounts()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $users = $this->usersModel->findAll();

        return view('admin/accounts', [
            'user' => $user,
            'users' => $users
        ]);
    }

    // ----------------- ORDERS -----------------
    public function orderRequests()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $db = \Config\Database::connect();
        $builder = $db->table('orders');
        $builder->select('orders.id, orders.order_number, orders.quantity, orders.status, orders.total_price, orders.created_at, items.title as item_name, users.first_name, users.last_name');
        $builder->join('items', 'items.id = orders.item_id', 'left');
        $builder->join('users', 'users.id = orders.user_id', 'left');
        $orders = $builder->get()->getResultArray();

        return view('admin/orders', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    // ----------------- USERS CRUD -----------------
    public function createUser()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        return view('admin/create_user', ['user' => $user]);
    }

    public function storeUser()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'password_hash' => $this->request->getPost('password'),
            'type'       => $this->request->getPost('type'),
            'account_status' => $this->request->getPost('account_status') ?? 1,
        ];

        $this->usersModel->insert($data);

        return redirect()->to('/admin/accounts')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $userToEdit = $this->usersModel->find($id);
        if (!$userToEdit) return redirect()->to('/admin/accounts')->with('error', 'User not found.');

        return view('admin/edit_user', [
            'user' => $user,
            'userToEdit' => $userToEdit
        ]);
    }

    public function updateUser($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'type' => $this->request->getPost('type'),
            'account_status' => $this->request->getPost('account_status') ? 1 : 0,
        ];

        $this->usersModel->update($id, $data);

        return redirect()->to('/admin/accounts')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $userToDelete = $this->usersModel->find($id);
        if (!$userToDelete) return redirect()->to('/admin/accounts')->with('error', 'User not found.');

        $this->usersModel->delete($id);

        return redirect()->to('/admin/accounts')->with('success', 'User deleted successfully.');
    }

    // ----------------- MENU ITEMS CRUD -----------------
    public function createItem()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        return view('admin/create_item', ['user' => $user]);
    }

    public function storeItem()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $data = [
            'title' => $this->request->getPost('title'),
            'cost' => $this->request->getPost('cost'),
            'is_available' => $this->request->getPost('is_available') ? 1 : 0,
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->itemsModel->insert($data);

        return redirect()->to('/admin/menu')->with('success', 'Menu item added successfully.');
    }

    public function editItem($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $item = $this->itemsModel->find($id);
        if (!$item) return redirect()->to('/admin/menu')->with('error', 'Item not found.');

        return view('admin/edit_item', [
            'user' => $user,
            'item' => $item
        ]);
    }

    public function updateItem($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $data = [
            'title' => $this->request->getPost('title'),
            'cost' => $this->request->getPost('cost'),
            'is_available' => $this->request->getPost('is_available') ? 1 : 0,
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->itemsModel->update($id, $data);

        return redirect()->to('/admin/menu')->with('success', 'Menu item updated successfully.');
    }

    public function deleteItem($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $item = $this->itemsModel->find($id);
        if (!$item) return redirect()->to('/admin/menu')->with('error', 'Item not found.');

        $this->itemsModel->delete($id);

        return redirect()->to('/admin/menu')->with('success', 'Menu item deleted successfully.');
    }

    // ----------------- ORDERS CRUD -----------------
    public function createOrder()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $items = $this->itemsModel->findAll();
        $users = $this->usersModel->findAll();

        return view('admin/create_order', [
            'user' => $user,
            'items' => $items,
            'users' => $users
        ]);
    }

    public function storeOrder()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $userId = $this->request->getPost('user_id');
        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');
        $status = $this->request->getPost('status') ?? 'Pending';

        if (!$this->usersModel->find($userId)) {
            return redirect()->back()->with('error', 'Selected user does not exist.');
        }
        if (!$this->itemsModel->find($itemId)) {
            return redirect()->back()->with('error', 'Selected item does not exist.');
        }

        $orderId = $this->ordersModel->insert([
            'user_id' => $userId,
            'item_id' => $itemId,
            'quantity' => $quantity,
            'status' => $status,
            'order_number' => null
        ]);

        $orderNumber = 'ORD' . str_pad($orderId, 5, '0', STR_PAD_LEFT);
        $this->ordersModel->update($orderId, ['order_number' => $orderNumber]);

        return redirect()->to('/admin/orders')->with('success', 'Order created successfully.');
    }

    public function editOrder($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $order = $this->ordersModel->find($id);
        if (!$order) return redirect()->to('/admin/orders')->with('error', 'Order not found.');

        $items = $this->itemsModel->findAll();

        return view('admin/edit_order', [
            'user' => $user,
            'order' => $order,
            'items' => $items
        ]);
    }

    public function updateOrder($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'item_id' => $this->request->getPost('item_id'),
            'quantity' => $this->request->getPost('quantity'),
            'status' => $this->request->getPost('status')
        ];

        $this->ordersModel->update($id, $data);

        return redirect()->to('/admin/orders')->with('success', 'Order updated successfully.');
    }

    public function deleteOrder($orderId)
    {
        $order = $this->ordersModel->find($orderId);
        if (!$order) return redirect()->back()->with('error', 'Order not found.');
        if ($order['status'] !== 'Completed') {
            return redirect()->back()->with('error', 'Only completed orders can be deleted.');
        }

        $this->ordersModel->delete($orderId);
        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
}
