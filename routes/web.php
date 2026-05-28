<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [WebAuthController::class, 'login'])->name('login');
Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login.form');