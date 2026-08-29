<?php

use Illuminate\Support\Facades\Route;





Route::livewire('departments', 'pages::departments.list')
    ->middleware('auth')
    ->name('departments.list');

Route::livewire('departments/create', 'pages::departments.create')
    ->middleware('auth')
    ->name('departments.create');

Route::livewire('departments/show/{id}', 'pages::departments.show')
    ->middleware('auth')
    ->name('departments.show');

Route::livewire('departments/delete/{id}', 'pages::departments.delete')
    ->middleware('auth')
    ->name('departments.delete');

Route::livewire('departments/update/{id}', 'pages::departments.update')
    ->middleware('auth')
    ->name('departments.edit');

