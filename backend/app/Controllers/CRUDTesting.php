<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class CRUDTesting extends BaseController
{
    // READ - list all users (styled)
    public function showUsersPage()
    {
        try {
            $model = new UsersModel();
            $data['users'] = $model->findAll(); // Fetch all users
        } catch (\Exception $e) {
            $data['users'] = [];
            session()->setFlashdata('error', 'Error fetching users: ' . $e->getMessage());
        }

        return view('test/users_styled', $data); // <-- styled view
    }

    // CREATE - show form
    public function create()
    {
        return view('test/user_create');
    }

    // CREATE - save new user
    public function store()
    {
        $model = new UsersModel();

        $data = [
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'password_hash'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'type'           => $this->request->getPost('type'),
            'account_status' => $this->request->getPost('account_status'),
        ];

        $model->save($data);

        return redirect()->to('/test/show');
    }

    // UPDATE - show edit form
    public function edit($id)
    {
        $model = new UsersModel();
        $data['user'] = $model->find($id);
        return view('test/user_update', $data);
    }

    // UPDATE - save edited data
    public function update($id)
    {
        $model = new UsersModel();

        $data = [
            'first_name'     => $this->request->getPost('first_name'),
            'last_name'      => $this->request->getPost('last_name'),
            'email'          => $this->request->getPost('email'),
            'type'           => $this->request->getPost('type'),
            'account_status' => $this->request->getPost('account_status'),
        ];

        $model->update($id, $data);

        return redirect()->to('/test/show');
    }

    // DELETE
    public function delete($id)
    {
        $model = new UsersModel();
        $model->delete($id);

        return redirect()->to('/test/show');
    }
}
