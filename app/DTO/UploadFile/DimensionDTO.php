<?php

namespace App\DTO\UploadFile;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class DimensionDTO extends DataTransferObject
{

    /**
     * @var int
     */
    #[MapFrom('height')]
    #[MapTo('height')]
    public int $height;

    /**
     * @var int
     */
    #[MapFrom('width')]
    #[MapTo('width')]
    public int $width;

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return ResizeImageDTO
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return ResizeImageDTO
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

}
