<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminAuthController;

Route::prefix('admin')->group(function () {

    // Public
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::post('/login',    [AdminAuthController::class, 'login']);

    // Forgot / Reset Password
    Route::post('/forgot-password', [AdminAuthController::class, 'forgotPassword']);
    Route::post('/reset-password',  [AdminAuthController::class, 'resetPassword']);

    // Protected (token required)
    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
    });

});



