<?php

namespace App\WebServices\Interfaces;

use App\DTO\Payment\ZarinPal\PaymentCallbackDTO;
use App\DTO\Payment\ZarinPal\PaymentDTO;
use App\Models\Payment;

interface IPaymentWebService
{
    public function paymentRequest(PaymentDTO $paymentDTO);

    public function paymentVerify(PaymentCallbackDTO $paymentCallbackDTO, Payment $payment);
}