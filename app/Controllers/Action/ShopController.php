<?php

namespace App\Controllers\Action;

use App\Services\Database\DBW;
use App\Services\Views\View;

class ShopController
{
    public function index()
    {
        $db = new DBW();
        $products = $db->select(['*'], 'products')->get();
        if (gettype(array_key_first($products)) == 'string') {
            View::render("shop", ["products" => [0 => $products]]);
        }

        View::render("shop", ["products" => $products]);
    }
}
