<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'invoices',
        'pages::invoices.index'
    )->name('invoices.index');

    Route::livewire(
        'invoices/show/{id}',
        'pages::invoices.show'
    )->name('invoices.show');

    Route::livewire(
        'invoices/create',
        'pages::invoices.create'
    )->name('invoices.create');

    Route::livewire(
        'invoices/{invoice}/items',
        'pages::invoices/items.create'
    )->name('invoice-items.create');

});