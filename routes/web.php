<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'middleware' => 'guest'], function () {
    // Get methods
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    // Post methods
    Route::post('/register', [RegisterController::class, 'store'])->name('store');
    Route::post('/login', [SessionController::class, 'store'])->name('login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/usuario/nuevo', [UserController::class, 'create'])->name('nuevoCajero');
    Route::post('/usuario', [UserController::class, 'store'])->name('user.new');


    Route::get('/monedas', [UserController::class, 'monedas'])->name('monedas');
    Route::get('/borrar_foto', [UserController::class, 'borrarFoto'])->name('borrarFoto');
    Route::get('/carnet', [UserController::class, 'carnet'])->name('carnet');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/qr/{usuario}/{id}', [UserController::class, 'lecturaQr'])->name('login_qr');
});

Route::post('/imagen', [UserController::class, 'saveImage'])->name('img');
