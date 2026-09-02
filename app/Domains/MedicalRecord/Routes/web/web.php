<?php

use Illuminate\Support\Facades\Route;

Route::livewire(
    'medical-records',
    'pages::medical-records.index'
)->middleware('auth')->name('medical-records.index');

Route::livewire(
    'medical-records/create',
    'pages::medical-records.create'
)->middleware('auth')->name('medical-records.create');

Route::livewire(
    'medical-records/update/{id}',
    'pages::medical-records.update'
)->middleware('auth')->name('medical-records.update');

Route::livewire(
    'medical-records/{id}',
    'pages::medical-records.show'
)->middleware('auth')->name('medical-records.show');
