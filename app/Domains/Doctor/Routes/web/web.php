<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'doctors',
        'pages::doctors.index'
    )->name('doctors.index');

    Route::livewire(
        'doctors/create',
        'pages::doctors.create'
    )->name('doctors.create');

    Route::livewire(
        'doctors/update/{id}',
        'pages::doctors.update'
    )->name('doctors.edit');

    Route::livewire(
        'doctors/delete/{id}',
        'pages::doctors.delete'
    )->name('doctors.delete');

    Route::livewire(
        'doctors/{id}',
        'pages::doctors.show'
    )->name('doctors.show');
});
