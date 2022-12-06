<?php

namespace App\Repositories\Setting\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ISettingRepository
{
    public function getUploadSettingsByTag(string $tag): Collection;
}
