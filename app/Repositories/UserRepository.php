<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        $attributes['password'] = bcrypt($attributes['password']);
        return parent::create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }
        return parent::update($id, $attributes);
    }
}