<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::group(['middleware' => 'auth'], function () {
    //cargan los modulos basicos de un pos
    Route::get('home',[HomeController::class, 'index']);
    Route::resource('usuarios',UserController::class)
        ->only('index','create','store','edit','update','destroy')->names('usuarios');
    //Cambiar contrasena de usuarios
    Route::get('cambiar-contrasena/{id}', [UserController::class, 'mostrarContrasena'])->name('usuario.form.cambiar-contrasena');
    Route::patch('cambiar-contrasena/{id}', [UserController::class, 'cambiarContrasena'])->name('usuario.cambiar-contrasena');
});

Route::namespace('Auth')->group(function(){
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
