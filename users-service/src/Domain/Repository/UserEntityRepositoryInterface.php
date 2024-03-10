<?php

namespace App\Domain\Repository;

use App\Domain\Entity\UserEntity;

interface UserEntityRepositoryInterface
{
    public function getById(int $id): ?UserEntity;

    public function save(UserEntity $userEntity): UserEntity;

    public function delete(UserEntity $userEntity): void;

    public function findByEmail(string $email): ?UserEntity;

    public function getAll(): array;
}
