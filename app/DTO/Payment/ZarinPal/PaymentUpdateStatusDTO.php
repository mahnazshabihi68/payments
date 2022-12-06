<?php

namespace App\DTO\Payment\ZarinPal;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class PaymentUpdateStatusDTO extends DataTransferObject
{
    /**
     * @var bool
     */
    #[MapFrom('status')]
    #[MapTo('status')]
    public bool $status;

    /**
     * @var int
     */
    #[MapFrom('user_id')]
    #[MapTo('user_id')]
    public int $user_id;

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

}
