<?php

namespace App\Controllers\Auth;

use App\Services\DBW;
use App\Services\Route;
use App\Services\Request;

class RegisterController
{
    public function register()
    {
        $model = new DBW();
        // $model->insert('users', Request::except(['q', 'password-confirm']));
        $model->select(['*'], 'users');
    }
}
