<?php

use Illuminate\Support\Facades\Route;








Route::livewire('prescriptions', 'pages::prescriptions.index')->middleware('auth')->name('prescriptions.index');
Route::livewire('prescriptions/{id}', 'pages::prescriptions.show')->middleware('auth')->name('prescriptions.show');


Route::livewire(
    'prescriptions/{prescription}/items',
    'pages::prescriptions.items.index_items'
)
    ->middleware('auth')
    ->name('prescriptions.items.index');

Route::livewire(
    'prescriptions/{prescription}/items/create',
    'pages::prescriptions.items.create_items'
)
    ->middleware('auth')
    ->name('prescriptions.items.create');

Route::livewire(
    'prescriptions/{prescription}/items/{item}',
    'pages::prescriptions.items.show_item'
)
    ->middleware('auth')
    ->name('prescriptions.items.show');

Route::livewire(
    'prescriptions/{prescription}/items/{item}/update',
    'pages::prescriptions.items.update_item'
)
    ->middleware('auth')
    ->name('prescriptions.items.edit');
