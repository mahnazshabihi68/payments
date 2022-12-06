<?php

namespace App\Services\Upload\Impls;

use App\DTO\UploadFile\UploadFileDTO;
use App\DTO\UploadFile\ImageUploadOptionDTO;
use App\Exceptions\UploadException;
use App\Services\Setting\Interfaces\ISettingService;
use App\Services\Upload\Interfaces\IUploadFileService;
use App\Transformers\UploadTransformer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

abstract class UploadFileAbstract implements IUploadFileService
{
    /**
     * @param ISettingService $settingService
     */
    public function __construct(public ISettingService $settingService)
    {
        //
    }

    /**
     * @param UploadFileDTO $fileDTO
     * @return UploadFileDTO
     */
    protected function prepareFile(UploadFileDTO $fileDTO): UploadFileDTO
    {
        if ($fileDTO->getOption() instanceof ImageUploadOptionDTO) {
            if ($fileDTO->getOption()->getResize()) {
                $image = Image::make($fileDTO->getFile())->resize(
                    $fileDTO->getOption()->getResize()->getDimension()->getWidth(),
                    $fileDTO->getOption()->getResize()->getDimension()->getHeight()
                );
                $fileDTO->setFile($image);
            }
            if ($fileDTO->getOption()->getCrop()) {
                $image = Image::make($fileDTO->getFile())->crop(
                    $fileDTO->getOption()->getCrop()->getDimension()->getWidth(),
                    $fileDTO->getOption()->getCrop()->getDimension()->getWidth(),
                    $fileDTO->getOption()->getCrop()->getX(),
                    $fileDTO->getOption()->getCrop()->getY(),
                );
                $fileDTO->setFile($image);
            }
        }

        return $fileDTO;
    }

    /**
     * @throws UploadException
     */
    protected function upload(UploadFileDTO $fileDTO, string $disk, string $path): string
    {
        $fullPath = $this->fullPath($fileDTO, $path);
        if ($fileDTO->getFile() instanceof \Intervention\Image\Image) {
            $result = Storage::disk($disk)->put(path: $fullPath, contents: $fileDTO->getFile()->save()->getEncoded());
        } else {
            $result = Storage::disk($disk)->put(path: $fullPath, contents: $fileDTO->getFile()->getContent());
        }
        if (!$result) {
            throw new UploadException(exceptionErrorCode: UploadException::UPLOAD_FAILED);
        }

        return $fileDTO->getName();
    }

    /**
     * @throws UploadException
     */
    protected function validateFile(UploadFileDTO $fileDTO): void
    {
        $acceptedMimes = $this->settingService->getUploadSettings()->getUploadMimes();
        $fileMime = $fileDTO->getExtension();
        if (!in_array($fileMime, $acceptedMimes)) {
            throw new UploadException(exceptionErrorCode: UploadException::UPLOAD_MIME_VALIDATE_FAILED);
        }

        $maximumAcceptedSize = $this->settingService->getUploadSettings()->getUploadMaxSize();
        if ($fileDTO->getSize() > $maximumAcceptedSize) {
            throw new UploadException(exceptionErrorCode: UploadException::UPLOAD_SIZE_VALIDATE_FAILED);
        }
    }

    /**
     * @param UploadFileDTO $fileDTO
     * @param string $path
     * @return string
     */
    protected function fullPath(UploadFileDTO $fileDTO, string $path): string
    {
        return $this->settingService->getUploadSettings()->getUploadBasePath() . $path . '/' . $fileDTO->getName();
    }

    /**
     * @param UploadFileDTO $originalUploadFileDTO
     * @param string $newName
     * @param array|null $newOptions
     * @return UploadFileDTO
     * @throws UnknownProperties|UploadException
     */
    protected function getCopyOfOriginalFile(
        UploadFileDTO $originalUploadFileDTO,
        string $newName,
        array $newOptions = null
    ): UploadFileDTO {
        $this->upload($originalUploadFileDTO, 'local', 'copy');
        $path = storage_path('app/' . $this->fullPath($originalUploadFileDTO, 'copy'));
        $copyFile = (new UploadedFile($path, $newName));
        $newUploadFileDTO = UploadTransformer::toUploadFileDTO($copyFile, $newOptions);
        $newUploadFileDTO->setName($newName);
        return $this->prepareFile($newUploadFileDTO);
    }
}
