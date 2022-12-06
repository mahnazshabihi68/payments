<?php

namespace App\WebServices\Impls;

use App\DTO\Payment\ZarinPal\PaymentCallbackDTO;
use App\DTO\Payment\ZarinPal\PaymentDTO;
use App\Models\Payment;
use App\WebServices\Interfaces\IPaymentWebService;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class ZarinPal implements IPaymentWebService
{
    /**
     * @var string
     */
    public string $MerchantID;
    protected string $zarin_pal_base_url;

    public function __construct()
    {
        $this->MerchantID = Config::get('app.zarin_pal_merchant_id');
        $this->zarin_pal_base_url = Config::get('app.zarin_pal_base_url');
    }


    /**
     * @param PaymentDTO $paymentDTO
     * @return Collection
     * @throws GuzzleException
     * @throws Exception
     */
    public function paymentRequest(PaymentDTO $paymentDTO): Collection
    {
        $trackingCode = Str::uuid();
        $callback = route('payment-callback', ['paymentId' => $trackingCode]);
        $result = collect(json_decode($this->client()->post('request.json', [
            'json' => [
                'merchant_id' => $this->MerchantID, // Determine merchant code
                'amount' => $paymentDTO->getAmount() * 10, // Transaction amount
                'recipient_sheba' => $paymentDTO->getRecipientSheba(), // Recipient Sheba
                'appendices' => $paymentDTO->getAppendices(), // Appendices
                'trackingCode' => $trackingCode, // Tracking code
                'callback_url' => $callback, // Return address after payment
            ]
        ])->getBody()->getContents()));

        if ($result['data'] && $result['data']->code == 100) {
            return collect([
                'authority' => $result['data']->authority,
                'url'       => 'https://www.zarinpal.com/pg/StartPay/' . $result['data']->authority,
                'callback_url'  => $callback,
                'tracking_code' => $trackingCode
            ]);
        } else {
            throw new Exception("ERR :" . $result['errors']->message);
        }
    }


    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function paymentVerify(PaymentCallbackDTO $paymentCallbackDTO, Payment $payment)
    {
        $result = collect(json_decode($this->client()->post('verify.json', [
            'json' => [
                'merchant_id' => $this->MerchantID, // Determine merchant code
                'authority'   => $paymentCallbackDTO->getAuthority(),
                'amount'     => $payment->amount * 10
            ]
        ])->getBody()->getContents()));

        if ($result['data']->code == 100) return $result['data']->ref_id;

        else throw new Exception(__('messages.failed'));

    }

    private function client(): Client
    {
        return new Client([
            'base_uri' => $this->zarin_pal_base_url,
            'http_errors' => false,
            'headers' => [
                'accept' => 'application/json',
                'Content-type' => 'application/json'
            ],
        ]);
    }
}
