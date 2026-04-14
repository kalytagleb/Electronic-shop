<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes — no token required
Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login',    'login');
    Route::post('auth/register', 'register');
});

// Protected routes — valid JWT token required
Route::prefix('auth')->middleware('auth:api')->controller(AuthController::class)->group(function () {
    Route::get('user',    'user');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});