<?php

namespace App\Services\Payment\Interfaces;

use App\DTO\Payment\ZarinPal\PaymentDTO;
use App\DTO\Payment\ZarinPal\PaymentUpdateStatusDTO;

interface IPaymentService
{
    public function paymentRequest(PaymentDTO $paymentDTO);

    public function updateStatus(PaymentUpdateStatusDTO $paymentStatusDTO);
}