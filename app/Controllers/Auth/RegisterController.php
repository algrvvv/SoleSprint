<?php

namespace App\Controllers\Auth;

use App\Services\DBW;
use App\Services\Helpers\Hash;
use App\Services\Route;
use App\Services\Request;

class RegisterController
{
    public function register()
    {
        $model = new DBW();
        $login = Request::query('login');
        $email = Request::query('email');
        $password = Request::query('password');
        $password_confirm = Request::query('password-confirm');

        $uniq_log = $model->select(['count(*) as count'], 'users')->where('login', "$login")->get();
        $uniq_email = $model->select(['count(*) as count'], 'users')->where('email', "$email")->get();

        if ($uniq_log['count'] > 0) {
            echo "Пользователей с таким логином уже есть";
        } else if ($uniq_email['count'] > 0) {
            echo "Пользователей с такой почтой уже есть";
        } else {
            if ($password === $password_confirm) {
                $password = Hash::make($password);
                try {
                    $attrs = [
                        "login" => $login,
                        "email"=> $email,
                        "password"=> $password
                    ];
                    $model->insert('users', $attrs);
                    Route::redirect('/login');
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "пароли разные";
            }
        }
    }
}
