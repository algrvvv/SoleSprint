<?php

namespace App\Controllers;

use App\Services\Session\Session;
use App\Services\Views\View;
use App\Services\Database\DBW;
use App\Services\Https\Request;
use App\Services\Https\Route;

class ProfileController
{
    /**
     * @param string $id
     * @param string $url
     * @param string $view
     */
    public function index(string $id, string $view)
    {
        $db = new DBW();
        $s = new Session();
        $res = $db->select(['*'], 'users')->where('id', $id)->get();
        if ($res == null) {
            Route::get_error_page(404);
        } else {
            if ($res['dop_id'] == null) {
                $s->create_session('values', ['profile_data' => $res]);
                View::render($view);
            } else {
                $owner_data = $db->select(['*'], 'owners')->where('id', $res['dop_id'])->get();
                $s->create_session('values', [
                    'profile_data' => $res,
                    'owner_data' => $owner_data
                ]);
                View::render($view);
            }
        }
    }
}
