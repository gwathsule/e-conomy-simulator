<?php

namespace App\Support;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * Number of items returned per page in a paged query.
     *
     * @var int $perPage
     */
    protected $perPage = 15;

    /**
     * Define the repository model class.
     *
     * @return string|Model Model class
     */
    abstract public function getModel(): string;

    /**
     * Get a new query builder.
     *
     * @return Builder
     */
    protected function newQuery()
    {
        return $this->getModel()::query();
    }

    /**
     * Retrieve model by any key.
     *
     * @param mixed $keyValue
     * @param string $keyName
     * @param array $relations
     * @return Model|null
     */
    public function getByKey(string $keyName, $keyValue, array $relations = [])
    {
        return $this->getById($keyValue, $keyName, $relations);
    }

    /**
     * Retrieve model by id.
     *
     * @param mixed $keyValue
     * @param string $keyName
     * @param array $relations
     * @return Model|null
     */
    public function getById($keyValue, string $keyName = 'id', array $relations = [])
    {
        return $this->newQuery()
            ->with($relations)
            ->where($keyName, $keyValue)
            ->first();
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function save(Model $model)
    {
        return $model->save();
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function update(Model $model)
    {
        return $model->save();
    }

    /**
     * @param Model $model
     * @return bool
     * @throws Exception
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }
}
