<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index(): string
    {
        return view('user/landing');
    }

    public function login(): string
    {
        // return the landing view
        return view('user/login');
    }
}
