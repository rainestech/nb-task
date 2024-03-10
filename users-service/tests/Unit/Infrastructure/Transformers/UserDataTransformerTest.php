<?php

namespace App\Tests\Unit\Infrastructure\Transformers;

use App\Domain\Entity\UserEntity;
use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;
use App\Infrastructure\Http\Requests\UserCreateRequest;
use App\Infrastructure\Transformers\UserDataTransformer;
use App\Tests\Unit\UnitTestCase;

class UserDataTransformerTest extends UnitTestCase
{
    public function testToCommandReturnsCreateUserCommand()
    {
        $entity = new UserEntity(
            firstName: self::FIRSTNAME,
            lastName: self::LASTNAME,
            email: self::EMAIL
        );
        $entity->setId(self::USER_ID);
        $data = UserDataTransformer::toCommand($entity);

        $this->assertTrue($data instanceof CreateUserCommand);
    }

    public function testReqToEntityReturnsUserEntity()
    {
        $data = new UserCreateRequest(
            firstName: self::FIRSTNAME,
            lastName: self::LASTNAME,
            email: self::EMAIL
        );
        $entity = UserDataTransformer::reqToEntity($data);

        $this->assertTrue($entity instanceof UserEntity);
    }

    public function testToEntityReturnsUserEntity()
    {
        $dto = new CreateUserCommand(
            id: self::USER_ID,
            firstName: self::FIRSTNAME,
            lastName: self::LASTNAME,
            email: self::EMAIL
        );
        $entity = UserDataTransformer::toEntity($dto);

        $this->assertTrue($entity instanceof UserEntity);
    }
}
