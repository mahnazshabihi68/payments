<?php

namespace App\DTO\UploadFile;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Image;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class UploadFileDTO extends DataTransferObject
{
    /**
     * @var UploadedFile|Image
     */
    #[MapFrom('file')]
    #[MapTo('file')]
    public UploadedFile|Image $file;

    /**
     * @var string
     */
    #[MapFrom('name')]
    #[MapTo('name')]
    public string $name;

    /**
     * @var string
     */
    #[MapFrom('extension')]
    #[MapTo('extension')]
    public string $extension;

    /**
     * @var int
     */
    #[MapFrom('size')]
    #[MapTo('size')]
    public int $size;

    /**
     * @var ImageUploadOptionDTO|null
     */
    #[MapFrom('option')]
    #[MapTo('option')]
    public ImageUploadOptionDTO|null $option;

    /**
     * @return UploadedFile|Image
     */
    public function getFile(): Image|UploadedFile
    {
        return $this->file;
    }

    /**
     * @param UploadedFile|Image $file
     * @return UploadFileDTO
     */
    public function setFile(Image|UploadedFile $file): self
    {
        $this->file = $file;
        return $this;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UploadFileDTO
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     * @return UploadFileDTO
     */
    public function setExtension(string $extension): self
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return UploadFileDTO
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return ImageUploadOptionDTO|null
     */
    public function getOption(): ?ImageUploadOptionDTO
    {
        return $this->option;
    }

    /**
     * @param ImageUploadOptionDTO|null $option
     * @return UploadFileDTO
     */
    public function setOption(?ImageUploadOptionDTO $option): self
    {
        $this->option = $option;
        return $this;
    }

}
