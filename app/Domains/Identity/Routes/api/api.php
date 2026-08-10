<?php

use App\Domains\Identity\Http\Controllers\Login\LoginController;
use App\Domains\Identity\Http\Controllers\Logout\LogoutController;
use App\Domains\Identity\Http\Controllers\Register\RegisterController;
use Illuminate\Support\Facades\Route;







Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);



Route::middleware('auth:api')->group(function () {
    Route::post('/logout', LogoutController::class);
});
