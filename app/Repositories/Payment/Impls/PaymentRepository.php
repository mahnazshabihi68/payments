<?php

namespace App\Repositories\Payment\Impls;

use App\DTO\Payment\ZarinPal\PaymentCallbackDTO;
use App\DTO\Payment\ZarinPal\PaymentDTO;
use App\DTO\Payment\ZarinPal\PaymentUpdateStatusDTO;
use App\Models\Payment;
use App\Repositories\Payment\Interfaces\IPaymentRepository;
use App\Services\Upload\Interfaces\IUploadFileService;
use App\Transformers\PaymentTransformer;
use App\WebServices\Interfaces\IPaymentWebService;

class PaymentRepository implements IPaymentRepository
{
    /**
     * @param IPaymentWebService $paymentWebService
     * @param Payment $payment
     */
    public function __construct(
        private readonly IPaymentWebService $paymentWebService,
        private readonly Payment            $payment,
        private readonly IUploadFileService $uploadFileService
    )
    {
    }

    public function getPayment($trackingCode)
    {
        return $this->payment::where('tracking_code', $trackingCode)->first();
    }

    public function store(PaymentDTO $paymentDTO)
    {
        $appendices = null;
        if ($paymentDTO->getAppendices()) {
            $appendices = $this->uploadFileService->uploadFile($paymentDTO->getAppendices(), 'local', 'appendices');
        }
        $this->payment->create(PaymentTransformer::toPairEntity($paymentDTO, $appendices));
    }

    public function paymentRequest(PaymentDTO $paymentInputDTO)
    {
        return $this->paymentWebService->paymentRequest($paymentInputDTO);
    }

    public function paymentVerify(PaymentCallbackDTO $paymentCallbackDTO)
    {
        $trackingCode = $paymentCallbackDTO->getTrackingCode();
        $payment = $this->getPayment($trackingCode);
        return $this->paymentWebService->paymentVerify($paymentCallbackDTO, $payment);
    }

    public function updateStatus(PaymentUpdateStatusDTO $paymentStatusDTO)
    {
        $this->payment->update((array)PaymentTransformer::toConfirmPayment($paymentStatusDTO));
    }
}