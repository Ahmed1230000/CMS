<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    // Roles

    Route::livewire(
        '/roles',
        'pages::roles.list'
    )->name('roles.list');

    Route::livewire(
        '/roles/create',
        'pages::roles.create'
    )->name('roles.create');

    Route::livewire(
        '/roles/show/{id}',
        'pages::roles.show'
    )->name('roles.show');

    Route::livewire(
        'role/{id}/permissions',
        'pages::roles.permissions'
    )->name('roles.permissions');


    // Permissions

    Route::livewire(
        '/permissions',
        'pages::permissions.list'
    )->name('permissions.list');

    Route::livewire(
        '/permissions/create',
        'pages::permissions.create'
    )->name('permissions.create');

    Route::livewire(
        '/permissions/show/{id}',
        'pages::permissions.show'
    )->name('permissions.show');


    // User Roles & Permissions

    Route::livewire(
        'user/{id}/roles',
        'pages::users.roles'
    )->name('users.roles');

    Route::livewire(
        'user/{id}/permissions',
        'pages::users.permissions'
    )->name('users.permissions');
});
