<?php

namespace App\Transformers;

use App\DTO\Payment\ZarinPal\PaymentDTO;
use App\DTO\Payment\ZarinPal\PaymentUpdateStatusDTO;
use App\Models\Payment;

class PaymentTransformer
{
    final public static function toPairEntity(
        PaymentDTO $paymentDTO,
        ?Payment   $payment = null,
                   $appendices = null
    ): Payment
    {
        $payment = $payment ?? new Payment();
        $payment->setAttribute('amount', $paymentDTO->getAmount());
        $payment->setAttribute('recipient_sheba', $paymentDTO->getRecipientSheba());
        $payment->setAttribute('appendices', $paymentDTO->getAppendices());
        $payment->setAttribute('tracking_code', $paymentDTO->getTrackingCode());
        return $payment;
    }

    final public static function toConfirmPayment(
        PaymentUpdateStatusDTO $paymentUpdateStatusDTO,
        ?Payment               $payment = null,
    ): Payment
    {
        $payment = $payment ?? new Payment();
        $payment->setAttribute('status', $paymentUpdateStatusDTO->getStatus());
        $payment->setAttribute('user_id', auth('user')->user()->id);
        return $payment;
    }
}