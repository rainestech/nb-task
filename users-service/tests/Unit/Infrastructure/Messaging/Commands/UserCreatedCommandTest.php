<?php

namespace App\Tests\Unit\Infrastructure\Messaging\Commands;

use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;
use App\Infrastructure\Messaging\Commands\UserCreatedCommand;
use App\Tests\Unit\UnitTestCase;

class UserCreatedCommandTest extends UnitTestCase
{

    public function testGetters(): void
    {
        $command = new UserCreatedCommand(
            new CreateUserCommand(
                self::USER_ID,
                self::FIRSTNAME,
                self::LASTNAME,
                self::EMAIL
            )
        );
        self::assertSame(self::USER_ID, $command->getData()->getId());
        self::assertSame(self::FIRSTNAME, $command->getData()->getFirstName());
        self::assertSame(self::LASTNAME, $command->getData()->getLastName());
        self::assertSame(self::EMAIL, $command->getData()->getEmail());
    }

    public function testSerialize(): void
    {
        $command = new UserCreatedCommand(
            new CreateUserCommand(
                self::USER_ID,
                self::FIRSTNAME,
                self::LASTNAME,
                self::EMAIL
            )
        );
        self::assertSame([
            'data' => [
                'id' => self::USER_ID,
                'firstName' => self::FIRSTNAME,
                'lastName' => self::LASTNAME,
                'email' => self::EMAIL
            ],
        ], $command->__serialize());
    }

    public function testUnserialize(): void
    {
        $command = new UserCreatedCommand(
            new CreateUserCommand(
                self::USER_ID,
                self::FIRSTNAME,
                self::LASTNAME,
                self::EMAIL
            )
        );
        $command->__unserialize($command->__serialize());
        self::assertSame(self::USER_ID, $command->getData()->getId());
        self::assertSame(self::FIRSTNAME, $command->getData()->getFirstName());
        self::assertSame(self::LASTNAME, $command->getData()->getLastName());
        self::assertSame(self::EMAIL, $command->getData()->getEmail());
    }
}
