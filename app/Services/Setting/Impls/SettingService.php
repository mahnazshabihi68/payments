<?php

namespace App\Services\Setting\Impls;

use App\DTO\UploadFile\UploadSettingDTO;
use App\Repositories\Setting\Interfaces\ISettingRepository;
use App\Services\Setting\Interfaces\ISettingService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class SettingService implements ISettingService
{
    public function __construct(public readonly ISettingRepository $settingRepository)
    {
    }

    /**
     * @inheritDoc
     * @throws UnknownProperties
     */
    public function getUploadSettings(): UploadSettingDTO
    {
        $uploadSettings = $this->settingRepository->getUploadSettingsByTag('upload');
        $preparedUploadSettings = [];
        foreach ($uploadSettings as $uploadSetting) {
            $preparedUploadSettings[$uploadSetting->getAttribute('key')] = json_decode(
                $uploadSetting->getAttribute('value')
            );
        }
        return new UploadSettingDTO($preparedUploadSettings);
    }
}
