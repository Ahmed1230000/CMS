<?php

use Illuminate\Support\Facades\Route;



Route::livewire('/users', 'pages::users.index')
    ->middleware('auth')
    ->name('users.index');

Route::livewire('/users/create', 'pages::users.create')
    ->middleware('auth')
    ->name('users.create');

Route::livewire('/users/delete', 'pages::users.delete')
    ->middleware('auth')
    ->name('users.delete');


Route::livewire('/users/show/{id}', 'pages::users.show')
    ->middleware('auth')
    ->name('users.show');
