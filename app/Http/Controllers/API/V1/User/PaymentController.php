<?php

namespace App\Http\Controllers\API\V1\User;

use App\DTO\Payment\ZarinPal\PaymentCallbackDTO;
use App\DTO\Payment\ZarinPal\PaymentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentCallback;
use App\Http\Requests\PaymentRequest;
use App\Services\Payment\Interfaces\IPaymentService;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class PaymentController extends Controller
{
    public function __construct(private readonly IPaymentService $paymentService)
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function paymentRequest(PaymentRequest $request): JsonResponse
    {
        $paymentInputDTO = new PaymentDTO($request->all());
        $referralCodeShowDTO = $this->paymentService->paymentRequest($paymentInputDTO);
        return $this->respondCreated($referralCodeShowDTO->toArray());
    }

    /**
     * @throws UnknownProperties
     * @throws \Exception
     */
    public function paymentCallback(PaymentCallback $request): JsonResponse
    {
        $paymentCallbackDTO = new PaymentCallbackDTO($request->all());
        $referralCodeShowDTO = $this->paymentService->paymentVerify($paymentCallbackDTO);
        return $this->respondCreated($referralCodeShowDTO->toArray());
    }
}
