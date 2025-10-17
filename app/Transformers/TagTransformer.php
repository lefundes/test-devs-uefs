<?php

namespace App\Transformers;

use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'posts'
    ];

    public function transform(Tag $tag): array
    {
        return [
            'id' => (int) $tag->id,
            'name' => $tag->name,
            'slug' => $tag->slug,
            'description' => $tag->description,
            'created_at' => $tag->created_at->toISOString(),
            'updated_at' => $tag->updated_at->toISOString(),
        ];
    }

    public function includePosts(Tag $tag)
    {
        return $this->collection($tag->posts, new PostTransformer());
    }
}