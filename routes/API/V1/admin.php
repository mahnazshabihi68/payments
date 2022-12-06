<?php

use Illuminate\Support\Facades\Route;

Route::namespace('API/V1/User')->group(function () {
    Route::post('payment-confirm', 'PaymentController@paymentConfirm')->name('payment-confirm');
});