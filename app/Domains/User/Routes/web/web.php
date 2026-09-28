<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;



Route::get('/email/verify/{id}/{hash}', function (
    EmailVerificationRequest $request
) {
    $request->fulfill();

    return redirect()->route('login');
})->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::livewire(
    '/email/verify',
    'pages::email.verify-email'
)->middleware('auth')
    ->name('verification.notice');

Route::livewire('/users', 'pages::users.index')
    ->middleware('auth')
    ->name('users.index');

Route::livewire('/users/create', 'pages::users.create')
    ->middleware('auth')
    ->name('users.create');

Route::livewire('/users/delete', 'pages::users.delete')
    ->middleware('auth')
    ->name('users.delete');


Route::livewire('/users/show/{id}', 'pages::users.show')
    ->middleware('auth')
    ->name('users.show');
