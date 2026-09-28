<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'employees',
        'pages::employees.index'
    )->name('employees.index');

    Route::livewire(
        'employees/create',
        'pages::employees.create'
    )->name('employees.create');

    Route::livewire(
        'employees/update/{id}',
        'pages::employees.update'
    )->name('employees.update');

    Route::livewire(
        'employees/delete/{id}',
        'pages::employees.delete'
    )->name('employees.delete');

    Route::livewire(
        'employees/{id}',
        'pages::employees.show'
    )->name('employees.show');
});
