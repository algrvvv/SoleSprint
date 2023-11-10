<?php

namespace App\Controllers\Auth;

use App\Services\Auth\Auth;
use App\Services\Database\DBW;
use App\Services\Helpers\Hash;
use App\Services\Https\Request;
use App\Services\Https\Route;
use App\Services\Session\Session;
use App\Services\Session\UserSession;

class LoginController
{
    public function login()
    {
        session_start();
        $s = new Session();
        $model = new DBW();
        $email = Request::query("email");
        $password = Request::query("password");

        if ($email != '' || $password != '') {
            $attrs = [
                'email' => $email,
                'password' => Hash::make($password)
            ];

            $auth = new Auth();
            if ($auth->attempt($attrs, 'users')) {
                $user_sess = new UserSession();
                $user_sess->create_session($auth->getUser());
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
        session_start();
        unset($_SESSION['user']);
        Route::redirect('/');
    }
}
