<?php
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Rutas de CRUD usuarios 
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/users', [UserController::class, 'index']); //listado de usuarios
Route::get('/users/{id}', [UserController::class, 'show']); //mostrar un solo usuario
Route::put('/users/{id}', [UserController::class, 'update']); //actualizar un usuario
Route::delete('/users/{id}', [UserController::class, 'destroy']); //eliminar un usuario
