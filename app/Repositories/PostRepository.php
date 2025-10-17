<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Collection;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function createWithTags(array $attributes, array $tagIds = [])
    {
        $post = $this->create($attributes);
        
        if (!empty($tagIds)) {
            $post->tags()->sync($tagIds);
        }

        return $post->load('tags');
    }

    public function updateWithTags($id, array $attributes, array $tagIds = [])
    {
        $post = $this->find($id);
        
        if ($post) {
            $post->update($attributes);
            
            if (!empty($tagIds)) {
                $post->tags()->sync($tagIds);
            }
            
            return $post->load('tags');
        }

        return null;
    }

    public function getPublishedPosts(): Collection
    {
        return $this->model->with(['user', 'tags'])
            ->where('published', true)
            ->orderBy('published_at', 'desc')
            ->get();
    }
}