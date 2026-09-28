<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'prescriptions',
        'pages::prescriptions.index'
    )->name('prescriptions.index');

    Route::livewire(
        'prescriptions/{id}',
        'pages::prescriptions.show'
    )->name('prescriptions.show');

    Route::livewire(
        'prescriptions/{prescription}/items',
        'pages::prescriptions.items.index_items'
    )->name('prescriptions.items.index');

    Route::livewire(
        'prescriptions/{prescription}/items/create',
        'pages::prescriptions.items.create_items'
    )->name('prescriptions.items.create');

    Route::livewire(
        'prescriptions/{prescription}/items/{item}',
        'pages::prescriptions.items.show_item'
    )->name('prescriptions.items.show');

    Route::livewire(
        'prescriptions/{prescription}/items/{item}/update',
        'pages::prescriptions.items.update_item'
    )->name('prescriptions.items.edit');
});
