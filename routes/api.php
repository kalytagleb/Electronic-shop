<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public routes
Route::post('login', [AuthController::class, 'login']);

// Private routes (JWT is needed)
Route::prefix('auth')->middleware('api')->controller(AuthController::class)->group(function() {
    Route::post('register', 'register');
    Route::get('user', 'user');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});