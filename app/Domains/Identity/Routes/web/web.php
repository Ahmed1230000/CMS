<?php

use App\Domains\Identity\Http\Controllers\Login\LoginController;
use App\Domains\Identity\Http\Controllers\Logout\LogoutController;
use App\Domains\Identity\Http\Controllers\Register\RegisterController;
use Illuminate\Support\Facades\Route;



Route::livewire('/register', 'pages::auth.register')->name('auth.register');

Route::post('/login', LoginController::class);

Route::livewire('/forget-password', 'pages::auth.forget-password')->name('auth.forget-password');

Route::livewire(
    '/reset-password/{token}',
    'pages::auth.reset-password'
)->name('password.reset');


Route::livewire(
    '/reset-password/{token}',
    'pages::auth.reset-password'
)->middleware('guest')
    ->name('password.reset');


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', LogoutController::class);
});
