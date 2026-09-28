<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'departments',
        'pages::departments.list'
    )->name('departments.list');

    Route::livewire(
        'departments/create',
        'pages::departments.create'
    )->name('departments.create');

    Route::livewire(
        'departments/show/{id}',
        'pages::departments.show'
    )->name('departments.show');

    Route::livewire(
        'departments/delete/{id}',
        'pages::departments.delete'
    )->name('departments.delete');

    Route::livewire(
        'departments/update/{id}',
        'pages::departments.update'
    )->name('departments.edit');

});