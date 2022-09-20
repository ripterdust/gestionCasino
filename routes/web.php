<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function () {
    // Get methods
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    // Post methods
    Route::post('/register', [RegisterController::class, 'store'])->name('store');
    Route::post('/login', [SessionController::class, 'store'])->name('login');
});

Route::group(['prefix' => 'auth', 'middleware' => 'auth'], function () {
    Route::get('/logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/carnet', [UserController::class, 'carnet'])->name('carnet');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/qr/{usuario}/{id}', [UserController::class, 'lecturaQr'])->name('login_qr');
});

Route::post('/imagen', [UserController::class, 'saveImage'])->name('img');
