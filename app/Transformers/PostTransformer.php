<?php

namespace App\Transformers;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'user',
        'tags'
    ];

    public function transform(Post $post): array
    {
        return [
            'id' => (int) $post->id,
            'title' => $post->title,
            'content' => $post->content,
            'published' => (bool) $post->published,
            'published_at' => $post->published_at?->toISOString(),
            'created_at' => $post->created_at->toISOString(),
            'updated_at' => $post->updated_at->toISOString(),
        ];
    }

    public function includeUser(Post $post)
    {
        return $this->item($post->user, new UserTransformer());
    }

    public function includeTags(Post $post)
    {
        return $this->collection($post->tags, new TagTransformer());
    }
}