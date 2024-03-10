<?php

namespace App\Infrastructure\Transformers;

use App\Domain\Entity\UserEntity;
use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;
use App\Infrastructure\Http\Requests\UserCreateRequest;

class UserDataTransformer
{
    public static function reqToEntity(UserCreateRequest $data): UserEntity
    {
        return new UserEntity($data->getFirstName(), $data->getLastName(), $data->getEmail());
    }

    public static function toCommand(UserEntity $data): CreateUserCommand
    {
        return new CreateUserCommand(
            id: $data->getId(),
            firstName: $data->getFirstName(),
            lastName: $data->getLastName(),
            email: $data->getEmail());
    }

    public static function toEntity(CreateUserCommand $dto): UserEntity
    {
        return new UserEntity($dto->getFirstName(), $dto->getLastName(), $dto->getEmail());
    }
}
