<?php

namespace App\Controllers\Action;

use App\Services\Https\Route;
use App\Services\Database\DBW;
use App\Services\Https\Request;
use App\Services\Session\Session;
use App\Services\Validators\Validator;

class ProductController
{
    public function store()
    {
        $valid = new Validator();
        $db = new DBW();
        $s = new Session();
        $attrs = [
            "name" => Request::query("name"),
            "description" => Request::query("description"),
            "price"=> Request::query("price"),
            "tegs" => Request::query("tegs"),
        ];
        $name = Request::query("name");
        $desc = Request::query("description");
        $tegs = Request::query("tegs");

        if ($valid->check_empty_value($attrs)) {
            $check_files = $_FILES['photo']['type'] ?? null;
            if($check_files != null && ($check_files == 'image/png' || $check_files == 'image/jpeg')){
                $photo = $_FILES['photo'];
                echo "<pre>";
                print_r($photo);
                echo "</pre>";
                $file_name = 'uploads/products/' . date('Y_m_d_H_i_s', time()) . '_' . $photo['name'];
                if(!move_uploaded_file($photo['tmp_name'],  $file_name)){
                    $s->create_session('errors', "ошибка загрузки фото");
                    Route::redirect('/create/product');
                } else {
                    $attrs = array_merge($attrs, ['photo' => $file_name]);
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
}
