<?php

namespace App\Controllers\Action;

use App\Services\Auth\Auth;
use App\Services\Database\DBW;
use App\Services\Https\Request;
use App\Services\Https\Route;
use App\Services\Session\Session;
use App\Services\Validators\Validator;

class SellerController
{
    public function store()
    {
        $db = new DBW();
        $valid = new Validator();
        $s = new Session();
        $auth = new Auth();
        $name = Request::query("name");
        $phone = Request::query("phone");
        if ($valid->check_empty_value([$name, $phone])) {
            $attrs = [
                "name" => $name,
                "phone" => $phone
            ];
            if ($valid->check_unique_db($attrs, 'owners')) {
                $owner = $db->insert('owners', $attrs);
                $db->update(['dop_id' => $owner], ['id' => $auth->user()['id']], 'users');
                
                $url = "/profile/" . $auth->user()['id'];
                Route::redirect($url);
            } else {
                $s->create_session('errors', $valid->getErrrorMessage());
                Route::redirect('/getseller');
            }
        } else {
            $s->create_session('errors', 'Вы пропустили обязательные поля');
            Route::redirect('/getseller');
        }
    }
}
