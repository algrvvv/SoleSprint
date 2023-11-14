<?php

namespace App\Controllers\Action;

use App\Services\Auth\Auth;
use App\Services\Views\View;
use App\Services\Https\Route;
use App\Services\Database\DBW;
use App\Services\Https\Request;
use App\Services\Validators\Validator;

class AppsController
{
    public function index()
    {
        $db = new DBW();
        $data = $db->select(['*'], 'owners')->get();
        View::render('pages/dashboard', ['data' => $data]);
    }

    public function show()
    {
        $db = new DBW();
        $auth = new Auth();
        $uid = $auth->user()['dop_id'] ?? null;
        if ($uid != null) {
            $data = $db->select(['*'], 'owners')->where('id', $uid)->get();
            View::render("pages/apps", ["data" => $data]);
        } else {
            View::render("pages/apps");
        }
    }

    public function accept(string $id)
    {
        $valid = new Validator();
        $db = new DBW();
        if (!$valid->check_unique_db(["id" => $id], 'owners')) {
            $db->update(['status' => 'verified'], ['id' => $id], 'owners');
            Route::redirect('/dashboard');
        } else {
            Route::redirect('/dashboard');
        }
    }

    public function reject(string $id)
    {
        $db = new DBW();
        $valid = new Validator();
        if (!$valid->check_unique_db(["id" => $id], 'owners')) {
            $db->update(['status' => 'rejected'], ['id' => $id], 'owners');
            Route::redirect('/dashboard');
        } else {
            Route::redirect('/dashboard');
        }
    }
}
