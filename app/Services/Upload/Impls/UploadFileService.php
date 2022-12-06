<?php

namespace App\Services\Upload\Impls;

use App\DTO\UploadFile\ImageUploadOptionDTO;
use App\DTO\UploadFile\UploadFileDTO;
use App\DTO\UploadFile\UploadFileResponseDTO;
use App\Exceptions\UploadException;
use App\Services\Setting\Interfaces\ISettingService;
use App\Services\Upload\Interfaces\IUploadFileService;
use App\Transformers\UploadTransformer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UploadFileService extends UploadFileAbstract implements IUploadFileService
{
    /**
     * @param ISettingService $settingService
     */
    public function __construct(public ISettingService $settingService)
    {
        parent::__construct($settingService);
    }

    /**
     * @throws UnknownProperties
     * @throws UploadException
     */
    public function uploadFile(
        UploadedFile $file,
        string $disk,
        string $path,
        array $options = null,
    ): UploadFileResponseDTO {
        $uploadFileDTO = UploadTransformer::toUploadFileDTO($file, $options);
        $this->validateFile($uploadFileDTO);

        if ($uploadFileDTO->getOption()) {
            if ($uploadFileDTO->getOption()->getResize()) {
                $prepareResizeUploadFile = $this->getCopyOfOriginalFile(
                    $uploadFileDTO,
                    hash('md5', 'resize-' . $uploadFileDTO->getName()) . '.' . $uploadFileDTO->getExtension(),
                    ['resize' => $uploadFileDTO->getOption()->getResize()->toArray()]
                );
                //upload file with resize
                $resizeFileName = $this->upload($prepareResizeUploadFile, $disk, $path);
            }
            if ($uploadFileDTO->getOption()->getCrop()) {
                $prepareCropUploadFile = $this->getCopyOfOriginalFile(
                    $uploadFileDTO,
                    hash('md5', 'crop-' . $uploadFileDTO->getName()) . '.' . $uploadFileDTO->getExtension(),
                    ['crop' => $uploadFileDTO->getOption()->getCrop()->toArray()]
                );
                //upload file with crop
                $cropFileName = $this->upload($prepareCropUploadFile, $disk, $path);
            }
        }

        //upload file without any change
        $prepareOriginalUploadFile = $this->getCopyOfOriginalFile(
            $uploadFileDTO,
            hash('md5', 'original-' . $uploadFileDTO->getName()) . '.' . $uploadFileDTO->getExtension(),
        );
        $mainFileName = $this->upload($prepareOriginalUploadFile, $disk, $path);

        //delete copy file after storing images
        $copyFilePath = storage_path('app/' . $this->fullPath($uploadFileDTO, 'copy'));
        File::delete($copyFilePath);

        return new UploadFileResponseDTO(
            main_file_name: $mainFileName,
            crop_file_name: $cropFileName ?? null,
            resize_file_name: $resizeFileName ?? null,
        );
    }
}
