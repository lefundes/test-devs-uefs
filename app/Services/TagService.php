<?php

namespace App\Services;

use App\Repositories\TagRepository;
use Illuminate\Support\Collection;

class TagService
{
    public function __construct(
        private TagRepository $tagRepository
    ) {}

    public function getAllTags(): Collection
    {
        return $this->tagRepository->all();
    }

    public function getTagById($id)
    {
        return $this->tagRepository->find($id);
    }

    public function createTag(array $data)
    {
        return $this->tagRepository->create($data);
    }

    public function updateTag($id, array $data): bool
    {
        return $this->tagRepository->update($id, $data);
    }

    public function deleteTag($id): bool
    {
        return $this->tagRepository->delete($id);
    }
}