<?php

namespace App\DTO\UploadFile;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ResizeImageDTO extends DataTransferObject
{

    /**
     * @var DimensionDTO
     */
    #[MapFrom('dimension')]
    #[MapTo('dimension')]
    public DimensionDTO $dimension;

    /**
     * @return DimensionDTO
     */
    public function getDimension(): DimensionDTO
    {
        return $this->dimension;
    }

    /**
     * @param DimensionDTO $dimension
     * @return ResizeImageDTO
     */
    public function setDimension(DimensionDTO $dimension): self
    {
        $this->dimension = $dimension;
        return $this;
    }

}
