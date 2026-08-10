<?php

use Illuminate\Support\Facades\Route;






Route::livewire('/roles', 'pages::roles.list')
    ->middleware('auth')
    ->name('roles.list');

Route::livewire('/roles/create', 'pages::roles.create')
    ->middleware('auth')
    ->name('roles.create');

Route::livewire('/roles/show/{id}', 'pages::roles.show')
    ->middleware('auth')
    ->name('roles.show');

Route::livewire('role/{id}/permissions', 'pages::roles.permissions')
    ->middleware('auth')
    ->name('roles.permissions');

Route::livewire('/permissions', 'pages::permissions.list')
    ->middleware('auth')
    ->name('permissions.list');

Route::livewire('/permissions/create', 'pages::permissions.create')
    ->middleware('auth')
    ->name('permissions.create');

Route::livewire('/permissions/show/{id}', 'pages::permissions.show')
    ->middleware('auth')
    ->name('permissions.show');

Route::livewire('user/{id}/roles', 'pages::users.roles')
    ->middleware('auth')
    ->name('users.roles');

Route::livewire('user/{id}/permissions', 'pages::users.permissions')
    ->middleware('auth')
    ->name('users.permissions');
