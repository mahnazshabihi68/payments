<?php

namespace App\Repositories\Setting\Impls;

use App\Models\Setting;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Setting\Interfaces\ISettingRepository;
use Illuminate\Database\Eloquent\Collection;

class SettingRepository extends BaseRepository implements ISettingRepository
{
    /**
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function getUploadSettingsByTag(string $tag): Collection{
        return $this->model->where('tag', $tag)->get();
    }
}
