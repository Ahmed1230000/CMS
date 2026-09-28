<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire(
        'hrs',
        'pages::hrs.index'
    )->name('hrs.index');

    Route::livewire(
        'hrs/create',
        'pages::hrs.create'
    )->name('hrs.create');

    Route::livewire(
        'hrs/show/{id}',
        'pages::hrs.show'
    )->name('hrs.show');

    Route::livewire(
        'hrs/update/{id}',
        'pages::hrs.update'
    )->name('hrs.update');

    Route::livewire(
        'hrs/delete/{id}',
        'pages::hrs.delete'
    )->name('hrs.delete');
});
