<?php

namespace App\Services\Payment\Impls;

use App\DTO\Payment\ZarinPal\PaymentCallbackDTO;
use App\DTO\Payment\ZarinPal\PaymentDTO;
use App\DTO\Payment\ZarinPal\PaymentUpdateStatusDTO;
use App\Repositories\Payment\Interfaces\IPaymentRepository;
use App\Services\Payment\Interfaces\IPaymentService;

class PaymentService implements IPaymentService
{
    public function __construct(private readonly IPaymentRepository $paymentRepository)
    {
    }

    /**
     * @throws \Exception
     */
    public function paymentRequest(PaymentDTO $paymentDTO)
    {
        try {
            $payment = $this->paymentRepository->paymentRequest($paymentDTO);
            $paymentDTO = new PaymentDTO($payment->toArray());
            $this->paymentRepository->store($paymentDTO);
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }

    /**
     * @throws \Exception
     */
    public function paymentVerify(PaymentCallbackDTO $paymentCallbackDTO)
    {
        try {
            return $this->paymentRepository->paymentVerify($paymentCallbackDTO);
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }

    public function updateStatus(PaymentUpdateStatusDTO $paymentStatusDTO)
    {
        $this->paymentRepository->updateStatus($paymentStatusDTO);
    }
}