<?php

use App\Services\Https\Route;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;

// $route = new Route();

// $route->get('/', 'home');
// $route->get('/shop', 'shop');
// $route->get('/login', 'login');
// $route->get('/register', 'register');
// $route->get('/dashboard', 'pages/dashboard')->middleware(['auth']);


// $route->post('/auth/register', RegisterController::class, 'register');
// $route->post('/auth/login', LoginController::class, 'login');
// $route->post('/auth/logout', LoginController::class, 'logout');

// $route->fallback();

Route::get('/', 'home');
Route::get('/shop', 'shop');
Route::get('/dashboard', 'pages/dashboard');

Route::get('/login', 'login');
Route::get('/register', 'register');

Route::post('/auth/register', RegisterController::class, 'register');
Route::post('/auth/login', LoginController::class, 'login');
Route::post('/auth/logout', LoginController::class, 'logout');


Route::middleware([
    '/dashboard' => 'auth',
    '/login' => 'guest',
    '/register' => 'guest'
]);

Route::fallback();
