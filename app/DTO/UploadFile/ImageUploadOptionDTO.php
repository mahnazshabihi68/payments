<?php

namespace App\DTO\UploadFile;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class ImageUploadOptionDTO extends DataTransferObject
{
    /**
     * @var ResizeImageDTO|null
     */
    #[MapFrom('resize')]
    #[MapTo('resize')]
    public ResizeImageDTO|null $resize;


    /**
     * @var CropImageDTO|null
     */
    #[MapFrom('crop')]
    #[MapTo('crop')]
    public CropImageDTO|null $crop;

    /**
     * @return ResizeImageDTO|null
     */
    public function getResize(): ?ResizeImageDTO
    {
        return $this->resize;
    }

    /**
     * @param ResizeImageDTO|null $resize
     * @return ImageUploadOptionDTO
     */
    public function setResize(?ResizeImageDTO $resize): self
    {
        $this->resize = $resize;
        return $this;
    }

    /**
     * @return CropImageDTO|null
     */
    public function getCrop(): ?CropImageDTO
    {
        return $this->crop;
    }

    /**
     * @param CropImageDTO|null $crop
     * @return ImageUploadOptionDTO
     */
    public function setCrop(?CropImageDTO $crop): self
    {
        $this->crop = $crop;
        return $this;
    }

}
