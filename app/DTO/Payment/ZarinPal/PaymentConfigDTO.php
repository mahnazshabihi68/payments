<?php

namespace App\DTO\Payment\ZarinPal;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class PaymentConfigDTO extends DataTransferObject
{
    /**
     * @var string
     */
    #[MapFrom('merchant_id')]
    #[MapTo('merchant_id')]
    public string $merchantId;

    /**
     * @var int
     */
    #[MapFrom('base_url')]
    #[MapTo('base_url')]
    public int $baseUrl;

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return int
     */
    public function getBaseUrl(): int
    {
        return $this->baseUrl;
    }

    /**
     * @param int $baseUrl
     */
    public function setBaseUrl(int $baseUrl): void
    {
        $this->baseUrl = $baseUrl;
    }
}
