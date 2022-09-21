<?php

use App\Http\Controllers\ClienteController;
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

    // Rutas de admin 
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/usuario/nuevo', [UserController::class, 'create'])->name('nuevoCajero');
    Route::post('/usuario', [UserController::class, 'store'])->name('user.new');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/cliente/new', [ClienteController::class, 'create'])->name('cliente.new');
    Route::post('/cliente/new', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get('/carnet/{id}', [ClienteController::class, 'carnet'])->name('carnet');

    // Rutas de cajero
    Route::get('/monedas', [ClienteController::class, 'monedas'])->name('monedas');
    Route::get('/monedas/{usuario}/{id}', [ClienteController::class, 'agregarMonedas'])->name('monedas.add');
    Route::post('/monedas/agregar', [ClienteController::class, 'guardarMonedas'])->name('monedas.store');

    Route::get('/borrar_foto', [UserController::class, 'borrarFoto'])->name('borrarFoto');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/qr/{usuario}/{id}', [ClienteController::class, 'validarQr'])->name('login_qr');
    Route::get('/cliente/{id}', [ClienteController::class, 'show'])->name('cliente.show');
});

Route::post('/imagen', [UserController::class, 'saveImage'])->name('img');
