<?php

use App\Controllers\Action\AppsController;
use App\Controllers\Action\SellerController;
use App\Services\Https\Route;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\ProfileController;

Route::get('/', 'home');
Route::get('/shop', 'shop');
// Админка
Route::get('/dashboard', 'pages/dashboard', [AppsController::class, 'index']);
Route::post('/dashboard/accept/{id}', AppsController::class, 'accept');
Route::post('/dashboard/reject/{id}', AppsController::class, 'reject');
// Админка
Route::get('/profile/{id}', 'pages/profile', [ProfileController::class, 'index']);
Route::get('/applications', 'pages/apps', [AppsController::class, 'show']);
Route::get('/getseller', 'pages/seller');

Route::get('/login', 'login');
Route::get('/register', 'register');

Route::post('/auth/register', RegisterController::class, 'register');
Route::post('/auth/login', LoginController::class, 'login');
Route::post('/auth/logout', LoginController::class, 'logout');
Route::post('/add/seller', SellerController::class, 'store');


Route::middleware([
    '/login' => 'guest',
    '/register' => 'guest',
    '/dashboard' => 'admin',
    '/getseller' => 'auth',
    '/applications' => 'auth',
]);

Route::fallback();
