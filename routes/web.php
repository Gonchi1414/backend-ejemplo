<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\WebUserController;
Route::get('/', function () {
    return view('welcome');
});
// esto es para login
Route::post('/login', [WebAuthController::class, 'login'])->name('login');
Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login.form');
// esto es para registro
Route::post('/register', [WebAuthController::class, 'register'])->name('register');
Route::get('/register', [WebAuthController::class, 'showRegister'])->name('register.form');
// Esto para dashBoard
Route::get('/dashboard', [WebAuthController::class, 'showDashboard'])->name('dashboard');
//logout
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');
// Rutas para gestión de usuarios (solo para admin)
Route::resource('users', WebUserController::class);