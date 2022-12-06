<?php

namespace App\DTO\UploadFile;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class CropImageDTO extends DataTransferObject
{
    /**
     * @var DimensionDTO
     */
    #[MapFrom('dimension')]
    #[MapTo('dimension')]
    public DimensionDTO $dimension;

    /**
     * @var int|null
     */
    #[MapFrom('x')]
    #[MapTo('x')]
    public ?int $x;

    /**
     * @var int|null
     */
    #[MapFrom('y')]
    #[MapTo('y')]
    public ?int $y;

    /**
     * @return DimensionDTO
     */
    public function getDimension(): DimensionDTO
    {
        return $this->dimension;
    }

    /**
     * @param DimensionDTO $dimension
     * @return CropImageDTO
     */
    public function setDimension(DimensionDTO $dimension): self
    {
        $this->dimension = $dimension;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getX(): ?int
    {
        return $this->x;
    }

    /**
     * @param int|null $x
     * @return CropImageDTO
     */
    public function setX(?int $x): self
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getY(): ?int
    {
        return $this->y;
    }

    /**
     * @param int|null $y
     * @return CropImageDTO
     */
    public function setY(?int $y): self
    {
        $this->y = $y;
        return $this;
    }

}
