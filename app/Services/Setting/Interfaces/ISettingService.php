<?php

namespace App\Services\Setting\Interfaces;

use App\DTO\UploadFile\UploadSettingDTO;

interface ISettingService
{
    /**
     * @return UploadSettingDTO
     */
    public function getUploadSettings(): UploadSettingDTO;
}
