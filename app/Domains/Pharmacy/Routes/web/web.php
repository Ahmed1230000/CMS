<?php

use Illuminate\Support\Facades\Route;

Route::livewire(
    'medicines',
    'pages::medicines.index'
)->middleware('auth')->name('medicines.index');

Route::livewire(
    'medicines/create',
    'pages::medicines.create'
)->middleware('auth')->name('medicines.create');

Route::livewire(
    'medicines/show/{id}',
    'pages::medicines.show'
)->middleware('auth')->name('medicines.show');

Route::livewire(
    'medicines/update/{id}',
    'pages::medicines.update'
)->middleware('auth')->name('medicines.update');


/////////////////////////////


Route::livewire(
    'medicines/{medicine}/items',
    'pages::medicine-items.index'
)->middleware('auth')->name('medicine-items.index');

Route::livewire(
    'medicines/{medicine}/items/create',
    'pages::medicine-items.create'
)->middleware('auth')->name('medicine-items.create');

Route::livewire(
    'medicines/{medicine}/items/{id}',
    'pages::medicine-items.show'
)->middleware('auth')->name('medicine-items.show');

Route::livewire(
    'medicines/{medicine}/items/{id}/update',
    'pages::medicine-items.update'
)->middleware('auth')->name('medicine-items.update');
