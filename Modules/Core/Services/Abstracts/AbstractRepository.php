<?php

namespace Modules\Core\Services\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Interfaces\RepositoryInterface;

/**
 * Abstract repository with basic CRUD.
 *
 * @package Modules\Core\Services\Abstracts
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * Model to be used for repository.
     *
     * @var Model
     */
    protected $model;

    /**
     * Class constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     * @see \Modules\Core\Interfaces\RepositoryInterface::getModel()
     */
    public function getModel()
    {
        return $this->model->newInstance();
    }

    /**
     * @inheritDoc
     * @see \Modules\Core\Interfaces\RepositoryInterface::create()
     */
    public function create(array $attributes)
    {
        return $this->model
            ->newInstance($attributes)
            ->save();
    }

    /**
     * @inheritDoc
     * @see \Modules\Core\Interfaces\RepositoryInterface::bulkCreate()
     */
    public function bulkCreate(array $rows)
    {
        $now = now()->toDateTimeString();

        // Laravel's bulk insert ignores timestamps, manually poopulate them
        foreach ($rows as &$row) {
            if (!array_key_exists('created_at', $row)) {
                $row['created_at'] = $now;
            }

            if (!array_key_exists('updated_at', $row)) {
                $row['updated_at'] = $now;
            }
        }

        return $this->model::insert($rows);
    }

    /**
     * @inheritDoc
     * @see \Modules\Core\Interfaces\RepositoryInterface::all()
     */
    public function all(array $columns = ['*'], array $with = [])
    {
        return $this->model
            ->with($with)
            ->get($columns);
    }

    /**
     * @inheritDoc
     * @see \Modules\Core\Interfaces\RepositoryInterface::find()
     */
    public function find(int $id, array $columns = ['*'], array $with = [])
    {
        return $this->model
            ->newInstance()
            ->with($with)
            ->find($id, $columns);
    }

    /**
     * @inheritDoc
     * @see \Modules\Core\Interfaces\RepositoryInterface::update()
     */
    public function update(int $id, array $attributes)
    {
        return $this->model
            ->newQuery()
            ->where('id', $id)
            ->update($attributes);
    }

    /**
     * @inheritDoc
     * @see \Modules\Core\Interfaces\RepositoryInterface::delete()
     */
    public function delete($ids)
    {
        return $this->model::destroy($ids);
    }
}
