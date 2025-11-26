<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\ItemsModel;
use App\Models\OrdersModel;

class Dashboard extends BaseController
{

    protected $ordersModel;
    protected $itemsModel;
    protected $usersModel;

    // Constructor to initialize models
    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->itemsModel  = new ItemsModel();
        $this->usersModel  = new UsersModel();
    }
    private function checkManager()
    {
        $session = session();
        $user = $session->get('user');

        if (!$user) {
            return redirect()->to('/login');
        }

        if (strtolower($user['type']) !== 'manager') {
            return redirect()->to('/no-access');
        }

        return $user;
    }

    // ----------------- DASHBOARD PAGES -----------------

    public function index()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        return view('admin/dashboard', ['user' => $user]);
    }

    public function menu()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $itemsModel = new ItemsModel();
        $items = $itemsModel->findAll(); // fetch all items

        return view('admin/menu', [
            'user' => $user,
            'items' => $items
        ]);
    }


    public function accounts()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $usersModel = new UsersModel();
        $users = $usersModel->findAll();

        return view('admin/accounts', [
            'user' => $user,
            'users' => $users
        ]);
    }

    public function menuItems()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('items'); // your table
        $items = $builder->get()->getResultArray(); // fetch all rows

        return view('admin/menu', [
            'items' => $items,
            'user'  => session()->get('user')
        ]);
    }

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

        $usersModel = new UsersModel();

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'password_hash' => $this->request->getPost('password'),
            'type'       => $this->request->getPost('type'),
            'account_status' => $this->request->getPost('account_status') ?? 1,
        ];

        $usersModel->insert($data);

        return redirect()->to('/admin/accounts')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $usersModel = new UsersModel();
        $userToEdit = $usersModel->find($id); // this must match an existing ID

        if (!$userToEdit) {
            return redirect()->to('/admin/accounts')->with('error', 'User not found.');
        }

        return view('admin/edit_user', [
            'user' => $user,
            'userToEdit' => $userToEdit
        ]);
    }


    public function updateUser($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $usersModel = new UsersModel();

        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'type' => $this->request->getPost('type'),
            'account_status' => $this->request->getPost('account_status') ? 1 : 0,
        ];

        $usersModel->update($id, $data);

        return redirect()->to('/admin/accounts')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $usersModel = new UsersModel();
        $userToDelete = $usersModel->find($id);

        if (!$userToDelete) {
            return redirect()->to('/admin/accounts')->with('error', 'User not found.');
        }

        $usersModel->delete($id);

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

        $itemsModel = new ItemsModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'cost' => $this->request->getPost('cost'),
            'is_available' => $this->request->getPost('is_available'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        $itemsModel->insert($data);

        return redirect()->to('/admin/menu')->with('success', 'Menu item added successfully.');
    }

    public function editItem($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $itemsModel = new ItemsModel();
        $item = $itemsModel->find($id);

        if (!$item) {
            return redirect()->to('/admin/menu')->with('error', 'Item not found.');
        }

        return view('admin/edit_item', [
            'user' => $user,
            'item' => $item
        ]);
    }

    public function updateItem($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $itemsModel = new ItemsModel();

        $data = [
            'title' => $this->request->getPost('title'),
            'cost' => $this->request->getPost('cost'),
            'is_available' => $this->request->getPost('is_available'),
            'is_active' => $this->request->getPost('is_active'),
        ];

        $itemsModel->update($id, $data);

        return redirect()->to('/admin/menu')->with('success', 'Menu item added successfully.');
    }

    public function deleteItem($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $itemsModel = new ItemsModel();
        $item = $itemsModel->find($id);

        if (!$item) {
            return redirect()->to('/admin/menu')->with('error', 'Item not found.');
        }

        $itemsModel->delete($id);

        return redirect()->to('/admin/menu')->with('success', 'Menu item added successfully.');
    }

    // ----------------- ORDERS -----------------
    // You can expand CRUD for orders if needed (approve/reject, delete, etc.)

    public function createOrder()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $itemsModel = new ItemsModel();
        $items = $itemsModel->findAll();

        $usersModel = new UsersModel();
        $users = $usersModel->findAll(); // <-- Add this

        return view('admin/create_order', [
            'user' => $user,
            'items' => $items,
            'users' => $users // <-- Pass to view
        ]);
    }


    public function storeOrder()
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $ordersModel = new OrdersModel();
        $usersModel  = new UsersModel();
        $itemsModel  = new ItemsModel();

        // Get POST data
        $userId = $this->request->getPost('user_id');
        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');
        $status = $this->request->getPost('status') ?? 'Pending';

        // Validate user_id exists
        if (!$usersModel->find($userId)) {
            return redirect()->back()->with('error', 'Selected user does not exist.');
        }

        // Validate item_id exists
        if (!$itemsModel->find($itemId)) {
            return redirect()->back()->with('error', 'Selected item does not exist.');
        }

        // Insert order
        $ordersModel->insert([
            'user_id'  => $userId,
            'item_id'  => $itemId,
            'quantity' => $quantity,
            'status'   => $status
        ]);

        return redirect()->to('/admin/orders')->with('success', 'Order created successfully.');
    }


    // Edit Order
    public function editOrder($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $ordersModel = new OrdersModel();
        $order = $ordersModel->find($id);

        if (!$order) {
            return redirect()->to('/admin/orders')->with('error', 'Order not found.');
        }

        $itemsModel = new ItemsModel();
        $items = $itemsModel->findAll();

        return view('admin/edit_order', [
            'user' => $user,
            'order' => $order,
            'items' => $items
        ]);
    }

    // Update Order
    public function updateOrder($id)
    {
        $user = $this->checkManager();
        if ($user instanceof \CodeIgniter\HTTP\RedirectResponse) return $user;

        $ordersModel = new OrdersModel();

        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'item_id' => $this->request->getPost('item_id'),
            'quantity' => $this->request->getPost('quantity'),
            'status' => $this->request->getPost('status')
        ];

        $ordersModel->update($id, $data);

        return redirect()->to('/admin/orders')->with('success', 'Order updated successfully.');
    }

    // Delete Order
    public function deleteOrder($orderId)
    {
        $order = $this->ordersModel->find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Only allow deleting if the order is completed
        if ($order['status'] !== 'Completed') {
            return redirect()->back()->with('error', 'Only completed orders can be deleted.');
        }

        $this->ordersModel->delete($orderId);

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
}
