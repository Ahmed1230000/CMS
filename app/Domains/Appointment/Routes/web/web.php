<?php

use Illuminate\Support\Facades\Route;

Route::livewire(
    'appointments',
    'pages::appointments.index'
)->middleware('auth')->name('appointments.index');

Route::livewire(
    'appointments/create',
    'pages::appointments.create'
)->middleware('auth')->name('appointments.create');

Route::livewire(
    'appointments/update/{id}',
    'pages::appointments.update'
)->middleware('auth')->name('appointments.update');

Route::livewire(
    'appointments/{id}',
    'pages::appointments.show'
)->middleware('auth')->name('appointments.show');
