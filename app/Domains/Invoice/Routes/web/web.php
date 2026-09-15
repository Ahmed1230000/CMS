<?php

use Illuminate\Support\Facades\Route;


Route::livewire(
    'invoices',
    'pages::invoices.index'
)->middleware('auth')
    ->name('invoices.index');

Route::livewire(
    'invoices/show/{id}',
    'pages::invoices.show'
)->middleware('auth')
    ->name('invoices.show');

Route::livewire(
    'invoices/create',
    'pages::invoices.create'
)->middleware('auth')
    ->name('invoices.create');


    Route::livewire(
    'invoices/{invoice}/items',
    'pages::invoices/items.create'
)->middleware('auth')
 ->name('invoice-items.create');
