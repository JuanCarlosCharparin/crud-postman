<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


// Rutas CRUD sin autenticación

// Ruta para obtener todos los usuarios (GET)
Route::get('/users', [UserController::class, 'index']);

// Ruta para crear un nuevo usuario (POST)
Route::post('/users', [UserController::class, 'store']);

// Ruta para obtener un usuario específico (GET)
Route::get('/users/{user}', [UserController::class, 'show']);

// Ruta para actualizar un usuario específico (PUT/PATCH)
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Ruta para eliminar un usuario específico (DELETE)
Route::delete('/users/{user}', [UserController::class, 'destroy']);

