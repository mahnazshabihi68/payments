<?php

namespace App\DTO\Payment\ZarinPal;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class PaymentDTO extends DataTransferObject
{
    /**
     * @var float|null
     */
    #[MapFrom('amount')]
    #[MapTo('amount')]
    public ?float $amount;

    /**
     * @var string|null
     */
    #[MapFrom('recipient_sheba')]
    #[MapTo('recipient_sheba')]
    public ?string $recipientSheba;

    /**
     * @var UploadedFile|null
     */
    #[MapFrom('appendices')]
    #[MapTo('appendices')]
    public ?UploadedFile $appendices;

    /**
     * @var string|null
     */
    #[MapFrom('callback_url')]
    #[MapTo('callback_url')]
    public ?string $callbackUrl;

    /**
     * @var string|null
     */
    #[MapFrom('tracking_code')]
    #[MapTo('tracking_code')]
    public ?string $trackingCode;

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     */
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string|null
     */
    public function getRecipientSheba(): ?string
    {
        return $this->recipientSheba;
    }

    /**
     * @param string|null $recipientSheba
     */
    public function setRecipientSheba(?string $recipientSheba): void
    {
        $this->recipientSheba = $recipientSheba;
    }

    /**
     * @return UploadedFile|null
     */
    public function getAppendices(): ?UploadedFile
    {
        return $this->appendices;
    }

    /**
     * @param UploadedFile|null $appendices
     */
    public function setAppendices(?UploadedFile $appendices): void
    {
        $this->appendices = $appendices;
    }

    /**
     * @return string|null
     */
    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    /**
     * @param string|null $callbackUrl
     */
    public function setCallbackUrl(?string $callbackUrl): void
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return string|null
     */
    public function getTrackingCode(): ?string
    {
        return $this->trackingCode;
    }

    /**
     * @param string|null $trackingCode
     */
    public function setTrackingCode(?string $trackingCode): void
    {
        $this->trackingCode = $trackingCode;
    }
}
