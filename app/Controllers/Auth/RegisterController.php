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
        $check_num = $model->select(['count(*) as count'], 'users')->where('login', 'newlogin')->get();
        
        echo "<pre>";
        print_r($check_num);
        echo "</pre> <br>";
        
        echo "<pre>";
        print_r($model->getQuery());
        echo "</pre> <br>";
    }
}
