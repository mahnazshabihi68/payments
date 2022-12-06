<?php

namespace App\Transformers;

use App\DTO\UploadFile\UploadFileDTO;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UploadTransformer
{
    /**
     * @throws UnknownProperties
     */
    final public static function toUploadFileDTO(
        UploadedFile $file,
        array $option = null,
    ): UploadFileDTO {
        $upload = [
            'file' => $file,
            'name' => $file->hashName(),
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'option' => $option,
        ];

        return new UploadFileDTO($upload);
    }
}
