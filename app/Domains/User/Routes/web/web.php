<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

// Email Verification
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


// Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::livewire('/users', 'pages::users.index')
        ->name('users.index');

    Route::livewire('/users/create', 'pages::users.create')
        ->name('users.create');

    Route::livewire('/users/delete', 'pages::users.delete')
        ->name('users.delete');

    Route::livewire('/users/show/{id}', 'pages::users.show')
        ->name('users.show');
});
