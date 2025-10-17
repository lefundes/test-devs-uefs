<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all(array $columns = ['*']);
    public function find($id, array $columns = ['*']);
    public function findWhere(array $criteria, array $columns = ['*']);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}