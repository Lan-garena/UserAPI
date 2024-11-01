<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth_group')->prefix('auth')->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::get('refresh', 'refresh');
        Route::post('logout', 'logout');
    });
});

Route::middleware('guest_group')->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::post('login', 'login');
        Route::post('register', 'register');
    });
});

