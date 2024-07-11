<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas por autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    // Rutas accesibles solo para administradores
    Route::middleware(['role:admin'])->group(function () {
        Route::get('customers', [CustomerController::class, 'index']);
        Route::post('customers', [CustomerController::class, 'store']);
        Route::get('hobby/{id}/customers', [CustomerController::class, 'getCustomersByHobby']);
    });

    // Rutas accesibles para administradores y clientes para sus propios datos
    Route::middleware(['role:admin,view'])->group(function () {
        Route::get('customers/{customer}', [CustomerController::class, 'show']);
    });

    Route::middleware(['role:admin,update'])->group(function () {
        Route::put('customers/{customer}', [CustomerController::class, 'update']);
    });

    Route::middleware(['role:admin,delete'])->group(function () {
        Route::delete('customers/{customer}', [CustomerController::class, 'destroy']);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});


