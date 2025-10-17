<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Illuminate\Support\Collection;

class PostService
{
    public function __construct(
        private PostRepository $postRepository
    ) {}

    public function getAllPosts(): Collection
    {
        return $this->postRepository->all();
    }

    public function getPublishedPosts(): Collection
    {
        return $this->postRepository->getPublishedPosts();
    }

    public function getPostById($id)
    {
        return $this->postRepository->find($id);
    }

    public function createPost(array $data, array $tagIds = [])
    {
        return $this->postRepository->createWithTags($data, $tagIds);
    }

    public function updatePost($id, array $data, array $tagIds = [])
    {
        return $this->postRepository->updateWithTags($id, $data, $tagIds);
    }

    public function deletePost($id): bool
    {
        return $this->postRepository->delete($id);
    }
}