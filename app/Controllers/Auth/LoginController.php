<?php

namespace App\Controllers\Auth;

use App\Services\Auth\Auth;
use App\Services\Helpers\Hash;
use App\Services\Https\Request;
use App\Services\Https\Route;
use App\Services\Session\Session;

class LoginController
{
    public function login()
    {
        $s = new Session();
        $email = Request::query("email");
        $password = Request::query("password");

        if ($email != '' || $password != '') {
            $attrs = [
                'email' => $email,
                'password' => Hash::make($password)
            ];

            $auth = new Auth();
            if ($auth->attempt($attrs, 'users')) {
                $auth->login();
                Route::redirect('/');
            } else {
                $s->create_session('errors', $auth->getMessage());
                Route::redirect('/login');
            }
        } else {
            $s->create_session('errors', 'Вы пропустили обязательные поля');
            Route::redirect('/login');
        }
    }

    public function logout()
    {
        $auth = new Auth();
        $auth->logout();
        Route::redirect('/');
    }
}
