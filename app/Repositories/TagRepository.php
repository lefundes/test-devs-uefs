<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends BaseRepository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        if (!isset($attributes['slug'])) {
            $attributes['slug'] = \Str::slug($attributes['name']);
        }
        return parent::create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        if (isset($attributes['name']) && !isset($attributes['slug'])) {
            $attributes['slug'] = \Str::slug($attributes['name']);
        }
        return parent::update($id, $attributes);
    }
}