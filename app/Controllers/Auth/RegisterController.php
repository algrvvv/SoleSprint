<?php

namespace App\Controllers\Auth;

use App\Services\Https\Route;
use App\Services\Database\DBW;
use App\Services\Helpers\Hash;
use App\Services\Https\Request;
use App\Services\Session\Session;
use App\Services\Validators\Validator;

class RegisterController
{
    public function register()
    {
        $s = new Session();
        $model = new DBW();
        $valid = new Validator();
        $login = Request::query('login');
        $email = Request::query('email');
        $password = Request::query('password');
        $password_confirm = Request::query('password-confirm');

        if ($valid->check_empty_value(Request::all())) {
            if ($valid->check_unique_db(Request::only(['login', 'email']), 'users')) {
                if ($password === $password_confirm) {
                    $password = Hash::make($password);
                    try {
                        $attrs = [
                            "login" => $login,
                            "email" => $email,
                            "password" => $password
                        ];

                        $model->insert('users', $attrs);
                        Route::redirect('/login');
                    } catch (\Exception $e) {
                        echo '' . $e->getMessage() . '';
                    }
                } else {
                    $s->create_session('errors', "Пароли не совпадают");
                    Route::redirect('/register');
                }
            } else {
                $s->create_session('errors', $valid->getErrrorMessage());
                Route::redirect('/register');
            }
        } else {
            $s->create_session('errors', $valid->getErrrorMessage());
            Route::redirect('/register');
        }
    }
}
