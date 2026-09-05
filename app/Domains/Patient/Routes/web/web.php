<?php

use App\Domains\Patient\Http\Controllers\Patient\{DownloadMedicalDocumentController, ViewMedicalDocumentController};
use Illuminate\Support\Facades\Route;

Route::livewire(
    'patients',
    'pages::patients.index'
)->middleware('auth')->name('patients.index');

Route::livewire(
    'patients/create',
    'pages::patients.create'
)->middleware('auth')->name('patients.create');

Route::livewire(
    'patients/update/{id}',
    'pages::patients.update'
)->middleware('auth')->name('patients.update');

Route::livewire(
    'patients/delete/{id}',
    'pages::patients.delete'
)->middleware('auth')->name('patients.delete');

Route::livewire(
    'patients/{id}',
    'pages::patients.show'
)->middleware('auth')->name('patients.show');


Route::get(
    'patients/{patient}/documents/{media}',
    ViewMedicalDocumentController::class
)
    ->middleware('auth')
    ->name('patients.documents.view');

Route::get(
    'patients/{patient}/documents/{media}/download',
    DownloadMedicalDocumentController::class
)
    ->middleware('auth')
    ->name('patients.documents.download');
