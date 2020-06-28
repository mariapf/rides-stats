<?php

namespace App\Infraestructure\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CoreRepository
{
    /**
     * Generic model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Creates new model.
     *
     * @param array $attributes
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        $entity = $this->getModel($attributes);
        $entity->save();

        return $entity;
    }

    /**
     * Updates model.
     *
     * @param Model $entity
     * @param array $attributes
     *
     * @throws Throwable
     *
     * @return Model
     */
    public function update(Model $entity, array $attributes)
    {
        $entity->fill($attributes);

        $entity->save();

        return $entity->fresh();
    }

    /** Updates or creates a model.
     * @param array $filters
     * @param array $attributes
     *
     * @return Builder|Model|mixed|object|null
     */
    public function createOrUpdate(array $filters, array $attributes)
    {
        $query = $this->getQuery();

        foreach ($filters as $column => $value) {
            $query->where($column, '=', $value);
        }

        if ($entity = $query->first()) {
            $entity = $this->update($entity, $attributes);
        } else {
            $entity = $this->create($attributes);
        }

        return $entity;
    }

    /**
     * Gets current model.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function getModel(array $attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Gets query object.
     *
     * @return Builder
     */
    public function getQuery()
    {
        return $this->getModel()->query();
    }

    /**
     * Find single record by a set of values.
     *
     * @param array $values
     *
     * @return Model
     */
    public function findOneBy(array $values)
    {
        $query = $this->getQuery();

        foreach ($values as $column => $value) {
            $query->where($column, '=', $value);
        }

        return $query->first();
    }

    public function findLastBy(array $values)
    {
        $query = $this->getQuery();

        foreach ($values as $column => $value) {
            $query->where($column, '=', $value);
        }

        return $query->latest('created_at')->first();
    }

    /**
     * Find model by id.
     *
     * @param string $id
     *
     * @return Model
     */
    public function findLastById(string $id)
    {
        return $this->findLastBy(['id' => $id]);
    }

    /**
     * Find all records for a give domain.
     *
     * @return Collection
     */
    public function findAll()
    {
        $query = $this->getQuery();

        return $query->get();
    }
}
