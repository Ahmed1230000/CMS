<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    // Medicines

    Route::livewire(
        'medicines',
        'pages::medicines.index'
    )->name('medicines.index');

    Route::livewire(
        'medicines/create',
        'pages::medicines.create'
    )->name('medicines.create');

    Route::livewire(
        'medicines/show/{id}',
        'pages::medicines.show'
    )->name('medicines.show');

    Route::livewire(
        'medicines/update/{id}',
        'pages::medicines.update'
    )->name('medicines.update');


    // Medicine Items

    Route::livewire(
        'medicines/{medicine}/items',
        'pages::medicine-items.index'
    )->name('medicine-items.index');

    Route::livewire(
        'medicines/{medicine}/items/create',
        'pages::medicine-items.create'
    )->name('medicine-items.create');

    Route::livewire(
        'medicines/{medicine}/items/{id}',
        'pages::medicine-items.show'
    )->name('medicine-items.show');

    Route::livewire(
        'medicines/{medicine}/items/{id}/update',
        'pages::medicine-items.update'
    )->name('medicine-items.update');
});
