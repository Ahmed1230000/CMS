<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'appointments',
        'pages::appointments.index'
    )->name('appointments.index');

    Route::livewire(
        'appointments/create',
        'pages::appointments.create'
    )->name('appointments.create');

    Route::livewire(
        'appointments/update/{id}',
        'pages::appointments.update'
    )->name('appointments.update');

    Route::livewire(
        'appointments/{id}',
        'pages::appointments.show'
    )->name('appointments.show');
});
