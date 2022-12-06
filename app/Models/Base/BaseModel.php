<?php

namespace App\Models\Base;

use App\Helpers\Date;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @method factory(int $int)
 * @method updateOrCreate(string[] $array, array $array1)
 * @method count()
 * @method find(int $id)
 * @method paginate(int $perPage = 20)
 * @method create(array $toArray)
 * @method where(string $string, int $id)
 * @method syncPermissions(array|int[] $permissions)
 */
class BaseModel extends Model
{
    /**
     * @var int
     */
    public const PAGINATION_CHUNK = 20;
    /**
     * @var int
     */
    public const CACHE_TTL_PAGINATION = 60;//seconds
    /**
     * @var int
     */
    public const CACHE_TTL_SHOW = 60;//seconds
    /**
     * @var int
     */
    public const CACHE_TTL_INDEX = 60;//seconds
    /**
     * @var string
     */
    public const CACHE_KEY_INDEX = 'list:all:lang:%s';
    /**
     * @var string
     */
    public const CACHE_KEY_INDEX_ENABLED = 'list:all:enabled:lang:%s';
    /**
     * @var string
     */
    public const CACHE_KEY_PAGINATED = 'list:paginated:lang:%s:per_page:%s:current_page:%s';
    /**
     * @var string
     */
    public const CACHE_KEY_SHOW = 'show:lang:%s:id:%s';
    /**
     * @var string
     */
    public const ENABLED_FALSE = 0;
    /**
     * @var string
     */
    public const ENABLED_TRUE = 1;

    /*
    |--------------------------------------------------------------------------
    | Setters and Getters
    |--------------------------------------------------------------------------
    */
    /**
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => $value ? Date::toCarbonGregorianFormat($value, 'Y-m-d H:i:s') : null,
        );
    }

    /**
     * @return Attribute
     */
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => $value ? Date::toCarbonGregorianFormat($value, 'Y-m-d H:i:s') : null,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Functions
    |--------------------------------------------------------------------------
    */
    /**
     * Scope a query to only include active users.
     *
     * @param  Builder  $query
     * @return void
     */
    public function scopeEnabled(Builder $query): void
    {
        $query->where('enabled', self::ENABLED_TRUE);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  Builder  $query
     * @return void
     */
    public function scopeNotEnabled(Builder $query): void
    {
        $query->where('enabled', self::ENABLED_FALSE);
    }
}
