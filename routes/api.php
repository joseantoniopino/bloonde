<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas por autenticación
Route::middleware(['auth:sanctum'])->group(function () {
    // Rutas accesibles solo para administradores
    Route::middleware(['can:viewAny,App\Models\Customer'])->group(function () {
        Route::get('customers', [CustomerController::class, 'index']);
        Route::post('customers', [CustomerController::class, 'store']);
        Route::get('customers-by-hobby', [CustomerController::class, 'getCustomersByHobby']);
        Route::get('customers/pdf', PdfController::class);
    });

    // Rutas accesibles para administradores y clientes para sus propios datos
    Route::middleware(['can:view,customer'])->group(function () {
        Route::get('customers/{customer}', [CustomerController::class, 'show']);
    });

    Route::middleware(['can:update,customer'])->group(function () {
        Route::put('customers/{customer}', [CustomerController::class, 'update']);
    });

    Route::middleware(['can:delete,customer'])->group(function () {
        Route::delete('customers/{customer}', [CustomerController::class, 'destroy']);
    });

    Route::post('logout', [AuthController::class, 'logout']);
});


