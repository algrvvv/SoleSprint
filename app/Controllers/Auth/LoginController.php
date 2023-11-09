<?php

namespace App\Controllers\Auth;

use App\Services\Auth\Auth;
use App\Services\Database\DBW;
use App\Services\Helpers\Hash;
use App\Services\Https\Request;

class LoginController
{
    public function login()
    {
        $model = new DBW();
        $email = Request::query("email");
        $password = Request::query("password");

        if ($email != '' || $password != '') {
            $attrs = [
                'email'=> $email,
                'password'=> Hash::make($password)
            ];

            $auth = new Auth();
            if($auth->attempt($attrs, 'users')) {
                echo "вход выполнен";
                echo "<pre>";
                print_r($auth->getUser());
                echo "</pre>";
            } else {
                echo $auth->getMessage();
            }
            
        } else {
            echo "Вы пропустили обязательные поля";
        }
    }
}
