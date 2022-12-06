<?php

namespace App\Services\Upload\Interfaces;

use App\DTO\UploadFile\UploadFileResponseDTO;
use Illuminate\Http\UploadedFile;

interface IUploadFileService
{
    public function uploadFile(
        UploadedFile $file,
        string $disk,
        string $path,
        array $options = null
    ): UploadFileResponseDTO;
}
