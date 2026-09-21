<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Payment\Http\Controllers\Payment\PaymentController;
use App\Domains\Payment\Http\Controllers\Payment\PaymobPaymentResultController;
use App\Domains\Payment\Http\Controllers\Payment\PaymobWebhookController;


Route::post(
    '/payments/paymob/webhook',
    PaymobWebhookController::class
)->name('payments.paymob.webhook');

Route::get(
    '/payments/paymob/result',
    PaymobPaymentResultController::class
)->name('payments.paymob.result');
