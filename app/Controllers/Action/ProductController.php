<?php

namespace App\Controllers\Action;

use App\Services\Auth\Auth;
use App\Services\Https\Route;
use App\Services\Database\DBW;
use App\Services\Https\Request;
use App\Services\Session\Session;
use App\Services\Validators\Validator;
use App\Services\Views\View;

class ProductController
{
    public function store()
    {
        $valid = new Validator();
        $db = new DBW();
        $s = new Session();
        $auth = new Auth();
        $attrs = [
            "name" => Request::query("name"),
            "description" => Request::query("description"),
            "price" => Request::query("price"),
            "tegs" => Request::query("tegs"),
        ];

        if ($valid->check_empty_value($attrs)) {
            $check_files = $_FILES['photo']['type'] ?? null;
            if ($check_files != null && ($check_files == 'image/png' || $check_files == 'image/jpeg')) {
                $photo = $_FILES['photo'];
                echo "<pre>";
                print_r($photo);
                echo "</pre>";
                $file_name = 'uploads/products/' . date('Y_m_d_H_i_s', time()) . '_' . $photo['name'];
                if (!move_uploaded_file($photo['tmp_name'],  $file_name)) {
                    $s->create_session('errors', "ошибка загрузки фото");
                    Route::redirect('/create/product');
                } else {
                    $attrs = array_merge($attrs, ['photo' => $file_name, 'owner_id' => $auth->user()['id']]);
                    $db->insert('products', $attrs);
                    $s->create_session('success', "товар добавлен");
                    Route::redirect('/create/product');
                }
            } else {
                $s->create_session('errors', "Картинка обязательна");
                Route::redirect('/create/product');
            }
        } else {
            $s->create_session('errors', $valid->getErrrorMessage());
            Route::redirect('/create/product');
        }
    }

    public function seller(string $id)
    {
        $db = new DBW();
        $start = false;
        $owners = $db->select(['owner_id'], 'products')->get();
        foreach ($owners as $owner) {
            if ($owner['owner_id'] == $id)
                $start = true;
            else
                continue;
        }

        if ($start) {
            $products = $db->select(['*'], 'products')->where('owner_id', $id)->get();
            $username = $db->select(['login'], 'users')->where('id', $id)->get();
            if (gettype(array_key_first($products)) == 'string') {
                View::render('pages/products/myproducts', ["products" => [0 => $products], "username" => $username]);
            } else {
                View::render('pages/products/myproducts', ["products" => $products, "username" => $username]);
            }
        } else {
            Route::get_error_page(404);
        }
    }

    public function show(string $id)
    {
        $valid = new Validator();
        $db = new DBW();

        if(!$valid->check_unique_db(['id' => $id], 'products')){
            $product = $db->select(['*'], 'products')->where('id', $id)->get();
            View::render('/pages/products/product', ['product'=> $product]);
        } else {
            Route::get_error_page(404);
        }
    }
}
