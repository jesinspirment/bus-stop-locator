<?php

namespace Modules\Core\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Get model.
     *
     * @return mixed
     */
    public function getModel();

    /**
     * Create new record.
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes);

    /**
     * Bulk create records.
     *
     * @param array $rows
     * @return mixed
     */
    public function bulkCreate(array $rows);

    /**
     * Get all records,
     *
     * @param array $columns
     * @param array $with
     * @return mixed
     */
    public function all(array $columns = ['*'], array $with = []);

    /**
     * Find record by ID.
     *
     * @param int $id
     * @param array $columns
     * @param array $with
     * @return Model
     */
    public function find(int $id, array $columns, array $with = []);

    /**
     * Update record.
     *
     * @param int $id
     * @param array $attributes
     * @return boolean
     */
    public function update(int $id, array $attributes);

    /**
     * Delete record. ID can be single or array.
     *
     * @param mixed $ids
     * @return boolean
     */
    public function delete($ids);
}
