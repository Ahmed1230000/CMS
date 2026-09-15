<?php

use Illuminate\Support\Facades\Route;

Route::livewire(
    'requests',
    'pages::requests.index'
)->middleware('auth')->name('requests.index');

Route::livewire(
    'requests/create',
    'pages::requests.create'
)->middleware('auth')->name('requests.create');

Route::livewire(
    'requests/show/{id}',
    'pages::requests.show'
)->middleware('auth')->name('requests.show');

Route::livewire(
    'requests/update/{id}',
    'pages::requests.update'
)->middleware('auth')->name('requests.update');
