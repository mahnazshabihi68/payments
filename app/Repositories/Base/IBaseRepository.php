<?php

namespace App\Repositories\Base;

use App\Models\Base\BaseModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

interface IBaseRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @return Collection
     */
    public function allEnabled(): Collection;

    /**
     * @param  int  $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = BaseModel::PAGINATION_CHUNK): LengthAwarePaginator;

    /**
     * @param  Model  $model
     * @return Model
     */
    public function create(Model $model): Model;

    /**
     * @param  int  $id
     * @return Model|null
     */
    public function findById(int $id): ?Model;

    /**
     * @param  Model  $model
     * @return Model
     */
    public function update(Model $model): Model;

    /**
     * @param  Model  $model
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * @param  int  $id
     * @return bool
     */
    public function isEnabled(int $id):bool;
}
