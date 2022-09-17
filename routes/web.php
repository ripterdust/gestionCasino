<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'middleware' => 'guest'], function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('store');
});

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    Route::get('/', function () {
        return 'hola';
    })->name('home');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
});
