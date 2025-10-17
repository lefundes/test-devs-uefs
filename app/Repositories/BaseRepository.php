<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    public function find($id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findWhere(array $criteria, array $columns = ['*']): Collection
    {
        return $this->model->where($criteria)->get($columns);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->model->find($id)->delete();
    }
}