<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    protected $users;

    public function __construct()
    {
        $this->users = new UsersModel();
    }

    // Show list of all users
    public function index()
    {
        $data['users'] = $this->users->findAll();
        return view('admin/users/index', $data);
    }

    // Show add form
    public function create()
    {
        return view('admin/users/create');
    }

    // Save new user
    public function store()
    {
        $data = [
            'first_name'      => $this->request->getPost('first_name'),
            'last_name'       => $this->request->getPost('last_name'),
            'email'           => $this->request->getPost('email'),
            'password_hash'   => $this->request->getPost('password'),
            'type'            => $this->request->getPost('type'),
            'account_status'  => $this->request->getPost('account_status')
        ];

        $this->users->save($data);
        return redirect()->to('/admin/users');
    }

    // Show edit form
    public function edit($id)
    {
        $data['user'] = $this->users->find($id);

        if (!$data['user']) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('admin/users/edit', $data);
    }

    // Update user
    public function update($id)
    {
        $data = [
            'id'              => $id,
            'first_name'      => $this->request->getPost('first_name'),
            'last_name'       => $this->request->getPost('last_name'),
            'email'           => $this->request->getPost('email'),
            'type'            => $this->request->getPost('type'),
            'account_status'  => $this->request->getPost('account_status')
        ];

        $this->users->save($data);
        return redirect()->to('/admin/users');
    }

    // Delete user
    public function delete($id)
    {
        $this->users->delete($id);
        return redirect()->to('/admin/users');
    }
}
