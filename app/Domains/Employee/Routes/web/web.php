<?php

use Illuminate\Support\Facades\Route;

Route::livewire(
    'employees',
    'pages::employees.index'
)->middleware('auth')->name('employees.index');

Route::livewire(
    'employees/create',
    'pages::employees.create'
)->middleware('auth')->name('employees.create');

Route::livewire(
    'employees/update/{id}',
    'pages::employees.update'
)->middleware('auth')->name('employees.update');

Route::livewire(
    'employees/delete/{id}',
    'pages::employees.delete'
)->middleware('auth')->name('employees.delete');

Route::livewire(
    'employees/{id}',
    'pages::employees.show'
)->middleware('auth')->name('employees.show');
