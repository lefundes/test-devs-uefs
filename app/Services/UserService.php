<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Collection;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function getAllUsers(): Collection
    {
        return $this->userRepository->all();
    }

    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser($id, array $data): bool
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id): bool
    {
        return $this->userRepository->delete($id);
    }
}