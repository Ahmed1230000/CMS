<?php

use App\Domains\Patient\Http\Controllers\Patient\{
    DownloadMedicalDocumentController,
    ViewMedicalDocumentController
};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    // Patients

    Route::livewire(
        'patients',
        'pages::patients.index'
    )->name('patients.index');

    Route::livewire(
        'patients/create',
        'pages::patients.create'
    )->name('patients.create');

    Route::livewire(
        'patients/update/{id}',
        'pages::patients.update'
    )->name('patients.update');

    Route::livewire(
        'patients/delete/{id}',
        'pages::patients.delete'
    )->name('patients.delete');

    Route::livewire(
        'patients/{id}',
        'pages::patients.show'
    )->name('patients.show');


    // Medical Documents

    Route::get(
        'patients/{patient}/documents/{media}',
        ViewMedicalDocumentController::class
    )->name('patients.documents.view');

    Route::get(
        'patients/{patient}/documents/{media}/download',
        DownloadMedicalDocumentController::class
    )->name('patients.documents.download');
});
