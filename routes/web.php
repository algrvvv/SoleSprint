<?php

use App\Controllers\Auth\RegisterController;
use App\Services\Route;

Route::get('/', 'home');
Route::get('/shop', 'shop');

Route::get('/login', 'login');
Route::get('/register', 'register');

Route::post('/auth/register', RegisterController::class, 'register');

Route::fallback();
