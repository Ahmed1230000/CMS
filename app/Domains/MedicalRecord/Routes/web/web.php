<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'medical-records',
        'pages::medical-records.index'
    )->name('medical-records.index');

    Route::livewire(
        'medical-records/create',
        'pages::medical-records.create'
    )->name('medical-records.create');

    Route::livewire(
        'medical-records/update/{id}',
        'pages::medical-records.update'
    )->name('medical-records.update');

    Route::livewire(
        'medical-records/{id}',
        'pages::medical-records.show'
    )->name('medical-records.show');

});