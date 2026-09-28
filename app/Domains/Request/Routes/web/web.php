<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'requests',
        'pages::requests.index'
    )->name('requests.index');

    Route::livewire(
        'requests/create',
        'pages::requests.create'
    )->name('requests.create');

    Route::livewire(
        'requests/show/{id}',
        'pages::requests.show'
    )->name('requests.show');

    Route::livewire(
        'requests/update/{id}',
        'pages::requests.update'
    )->name('requests.update');
});
