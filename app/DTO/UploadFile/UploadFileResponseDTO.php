<?php

namespace App\DTO\UploadFile;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class UploadFileResponseDTO extends DataTransferObject
{
    /**
     * @var string
     */
    #[MapFrom('main_file_name')]
    #[MapTo('main_file_name')]
    public string $mainFileName;

    /**
     * @var string|null
     */
    #[MapFrom('crop_file_name')]
    #[MapTo('crop_file_name')]
    public ?string $cropFileName;

    /**
     * @var string|null
     */
    #[MapFrom('resize_file_name')]
    #[MapTo('resize_file_name')]
    public ?string $resizeFileName;

    /**
     * @return string
     */
    public function getMainFileName(): string
    {
        return $this->mainFileName;
    }

    /**
     * @param string $mainFileName
     * @return UploadFileResponseDTO
     */
    public function setMainFileName(string $mainFileName): self
    {
        $this->mainFileName = $mainFileName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCropFileName(): ?string
    {
        return $this->cropFileName;
    }

    /**
     * @param string|null $cropFileName
     * @return UploadFileResponseDTO
     */
    public function setCropFileName(?string $cropFileName): self
    {
        $this->cropFileName = $cropFileName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getResizeFileName(): ?string
    {
        return $this->resizeFileName;
    }

    /**
     * @param string|null $resizeFileName
     * @return UploadFileResponseDTO
     */
    public function setResizeFileName(?string $resizeFileName): self
    {
        $this->resizeFileName = $resizeFileName;
        return $this;
    }

}
