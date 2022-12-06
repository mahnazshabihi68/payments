<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\User\PaymentController;

Route::namespace('API/V1/Admin')->group(function () {
    Route::post('payment-request', [PaymentController::class, 'paymentRequest'])->name('payment-request');
    Route::get('payment-call-back/{paymentId}', [PaymentController::class,'paymentCallback'])->name('payment-callback');
});