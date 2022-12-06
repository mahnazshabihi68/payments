<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\DTO\Payment\ZarinPal\PaymentUpdateStatusDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentConfirm;
use App\Models\Payment;
use App\Services\Payment\Interfaces\IPaymentService;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class PaymentController extends Controller
{
    public function __construct(private readonly IPaymentService $paymentService)
    {
        $this->middleware(['auth:admin']);

        $this->middleware('permission:confirmationPayment');
    }

    /**
     * @throws UnknownProperties
     */
    public function paymentConfirm(PaymentConfirm $request, Payment $payment)
    {
        if($request->status == 'true') {
            $paymentStatusDTO = new PaymentUpdateStatusDTO($request->all());
            $this->paymentService->updateStatus($paymentStatusDTO);
        }
    }
}
