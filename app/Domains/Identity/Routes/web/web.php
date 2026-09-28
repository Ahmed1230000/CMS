<?php

use App\Domains\Identity\Http\Controllers\Login\LoginController;
use App\Domains\Identity\Http\Controllers\Logout\LogoutController;
use Illuminate\Support\Facades\Route;


// Public / Guest Routes

Route::livewire(
    '/register',
    'pages::auth.register'
)->name('auth.register');

Route::post(
    '/login',
    LoginController::class
);

Route::livewire(
    '/forget-password',
    'pages::auth.forget-password'
)->name('auth.forget-password');

Route::middleware('guest')->group(function () {

    Route::livewire(
        '/reset-password/{token}',
        'pages::auth.reset-password'
    )->name('password.reset');
});


// Authenticated Routes

Route::middleware('auth:api')->group(function () {

    Route::post(
        '/logout',
        LogoutController::class
    );
});
