<?php

namespace App\Controllers\Action;

use App\Services\Auth\Auth;
use App\Services\Database\DBW;
use App\Services\Views\View;

class CartController
{
    public function index()
    {
        $auth = new Auth();
        $db = new DBW();
        $user = $auth->user() ?? null;
        if ($user == null) {
            echo "вы не вошли в аккаунт";
        } else {
            $favs = $auth->user()['favorites'];
            $products = $db->select(['*'], 'products')->where('id', $favs, separator: 'IN')->get();
            if (gettype(array_key_first($products)) == 'string') {
                View::render('pages/cart', ['products' => [0 => $products]]);
            } else {
                View::render('pages/cart', ['products' => $products]);
            }
        }
    }
}
