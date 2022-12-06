<?php

namespace App\DTO\Payment\ZarinPal;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class PaymentCallbackDTO extends DataTransferObject
{
    /**
     * @var string|null
     */
    #[MapFrom('authority')]
    #[MapTo('authority')]
    public ?string $authority;

    /**
     * @var string|null
     */
    #[MapFrom('url')]
    #[MapTo('url')]
    public ?string $url;

    /**
     * @var string|null
     */
    #[MapFrom('tracking_code')]
    #[MapTo('tracking_code')]
    public ?string $trackingCode;

    /**
     * @return string|null
     */
    public function getAuthority(): ?string
    {
        return $this->authority;
    }

    /**
     * @param string|null $authority
     */
    public function setAuthority(?string $authority): void
    {
        $this->authority = $authority;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
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
