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
    public function signup(): string
    {
        // return the landing view
        return view('user/signup');
    }
    public function moodboard(): string
    {
        // return the landing view
        return view('user/moodboard');
    }
    public function roadmap(): string
    {
        // return the landing view
        return view('user/roadmap');
    }
}
