<?php

use Illuminate\Support\Facades\Route;





Route::livewire(
    'invoices/{invoice}/payment',
    'pages::payments.create'
)->middleware(['auth', 'verified'])->name('payments.create');
