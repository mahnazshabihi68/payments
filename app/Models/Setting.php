<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Base\BaseModel;
use Carbon\Carbon;

/**
 * Class Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 *
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Setting extends BaseModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'key',
        'value',
        'tag'
    ];
}
