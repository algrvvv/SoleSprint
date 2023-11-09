<?php

use App\Services\Https\Route;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;


Route::get('/', 'home');
Route::get('/shop', 'shop');

Route::get('/login', 'login');
Route::get('/register', 'register');

Route::post('/auth/register', RegisterController::class, 'register');
Route::post('/auth/login', LoginController::class, 'login');
Route::post('/auth/logout', LoginController::class, 'logout');

Route::fallback();
