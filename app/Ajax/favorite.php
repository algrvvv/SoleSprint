<?php

namespace App\Ajax;

use App\Services\Auth\Auth;
use App\Services\Database\DBW;

session_start();

include '../Services/Auth/Auth.php';
include '../Services/Database/DBW.php';
include '../Services/Helpers/Helpers.php';


class Favorite
{
    public static function add_to_wishlist($id)
    {
        $favs = $_SESSION['user']['favorites'] ?? 0;
        if (strlen($favs) < 1) {
            $_SESSION['user']['favorites'] = $id;
        } else {
            if ($_SESSION['user']['favorites'] == '0') {
                $_SESSION['user']['favorites'] = $id;
            } else {
                $_SESSION['user']['favorites'] .= ', ' . $id;
            }
        }
        $auth = new Auth();
        $db = new DBW();
        /**
         * Uncaught Error: Class "App\Services\Auth\Auth" not found in 
         * D:
         * я смог это починить.. господи..
         */
        $uid = $auth->user()['id'];
        $db->update(['favorites' =>  $_SESSION['user']['favorites']], ['id' => $uid], 'users');
    }

    public static function remove_from_wishlist($id)
    {
        $auth = new Auth();
        $db = new DBW();

        $uid = $auth->user()['id'];

        if (strlen($_SESSION['user']['favorites']) <= 1) {
            $favs = str_split($_SESSION['user']['favorites']);
        } else {
            $favs = explode(', ', $_SESSION['user']['favorites']);
        }
        $index =  array_search($id, $favs);
        unset($favs[$index]);
        $_SESSION['user']['favorites'] = implode(', ', $favs);

        $db->update(['favorites' =>  $_SESSION['user']['favorites']], ['id' => $uid], 'users');
    }
}

$status = $_GET['status'];
$id = str_replace('svg', '',  $_GET['id_product']);
$condition = $_GET['condition'];

if ($condition == 'true') {
    Favorite::add_to_wishlist($id);
} else {
    Favorite::remove_from_wishlist($id);
}
