<?php

namespace App\DTO\UploadFile;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\DataTransferObject;

class UploadSettingDTO extends DataTransferObject
{

    /**
     * @var int
     */
    #[MapFrom('upload_max_size')]
    #[MapTo('upload_max_size')]
    public int $UploadMaxSize;

    /**
     * @var array
     */
    #[MapFrom('upload_mimes')]
    #[MapTo('upload_mimes')]
    public array $UploadMimes;

    /**
     * @var string
     */
    #[MapFrom('upload_base_path')]
    #[MapTo('upload_base_path')]
    public string $UploadBasePath;

    /**
     * @return int
     */
    public function getUploadMaxSize(): int
    {
        return $this->UploadMaxSize;
    }

    /**
     * @param int $UploadMaxSize
     * @return UploadSettingDTO
     */
    public function setUploadMaxSize(int $UploadMaxSize): self
    {
        $this->UploadMaxSize = $UploadMaxSize;
        return $this;
    }

    /**
     * @return array
     */
    public function getUploadMimes(): array
    {
        return $this->UploadMimes;
    }

    /**
     * @param array $UploadMimes
     * @return UploadSettingDTO
     */
    public function setUploadMimes(array $UploadMimes): self
    {
        $this->UploadMimes = $UploadMimes;
        return $this;
    }

    /**
     * @return string
     */
    public function getUploadBasePath(): string
    {
        return $this->UploadBasePath;
    }

    /**
     * @param string $UploadBasePath
     * @return UploadSettingDTO
     */
    public function setUploadBasePath(string $UploadBasePath): self
    {
        $this->UploadBasePath = $UploadBasePath;
        return $this;
    }
}
