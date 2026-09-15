<?php

use Illuminate\Support\Facades\Route;




Route::livewire('/', 'pages::auth.login')
    ->middleware('guest')
    ->name('login');

Route::livewire('/dashboard', 'pages::dashboard.index')
    ->middleware('auth')
    ->name('dashboard');

