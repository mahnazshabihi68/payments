<?php

namespace App\Repositories\Payment\Interfaces;

use App\DTO\Payment\ZarinPal\PaymentCallbackDTO;
use App\DTO\Payment\ZarinPal\PaymentDTO;
use App\DTO\Payment\ZarinPal\PaymentUpdateStatusDTO;

interface IPaymentRepository
{
    public function paymentRequest(PaymentDTO $paymentInputDTO);

    public function paymentVerify(PaymentCallbackDTO $paymentCallbackDTO);

    public function store(PaymentDTO $paymentDTO);

    public function updateStatus(PaymentUpdateStatusDTO $paymentStatusDTO);
}