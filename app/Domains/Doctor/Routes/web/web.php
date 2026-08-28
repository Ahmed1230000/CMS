<?php

use Illuminate\Support\Facades\Route;

Route::livewire(
    'doctors',
    'pages::doctors.index'
)
    ->middleware('auth')
    ->name('doctors.index');


Route::livewire(
    'doctors/create',
    'pages::doctors.create'
)
    ->middleware('auth')
    ->name('doctors.create');


Route::livewire(
    'doctors/update/{id}',
    'pages::doctors.update'
)
    ->middleware('auth')
    ->name('doctors.edit');


Route::livewire(
    'doctors/delete/{id}',
    'pages::doctors.delete'
)
    ->middleware('auth')
    ->name('doctors.delete');


Route::livewire(
    'doctors/{id}',
    'pages::doctors.show'
)
    ->middleware('auth')
    ->name('doctors.show');
