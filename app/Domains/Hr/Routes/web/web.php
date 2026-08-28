<?php

use Illuminate\Support\Facades\Route;






Route::livewire('hrs', 'pages::hrs.index')->middleware('auth')->name('hrs.index');
Route::livewire('hrs/create', 'pages::hrs.create')->middleware('auth')->name('hrs.create');
Route::livewire('hrs/show/{id}', 'pages::hrs.show')->middleware('auth')->name('hrs.show');
Route::livewire('hrs/update/{id}', 'pages::hrs.update')->middleware('auth')->name('hrs.update');
Route::livewire('hrs/delete/{id}', 'pages::hrs.delete')->middleware('auth')->name('hrs.delete');
