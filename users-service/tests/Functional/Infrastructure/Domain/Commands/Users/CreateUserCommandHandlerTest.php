<?php

namespace App\Tests\Functional\Infrastructure\Domain\Commands\Users;


use App\Domain\Entity\UserEntity;
use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;
use App\Infrastructure\Domain\Exception\EmailNotUniqueException;
use App\Tests\Functional\FunctionalTestCase;
use App\Tests\Unit\UnitTestCase;

class CreateUserCommandHandlerTest extends FunctionalTestCase
{
//    public function testInvokeReturnsUserEntity()
//    {
//        $command = new CreateUserCommand(
//            id: null,
//            firstName: UnitTestCase::FIRSTNAME,
//            lastName: UnitTestCase::LASTNAME,
//            email: UnitTestCase::EMAIL
//        );
//
//        $handler = $this->container->get(CreateUserCommandHandlerTest::class);
//
//
//        $entity = $handler->__invoke($command);
//
////        $this->assertTrue($entity instanceof UserEntity::class);
//        $this->assertNotNull($entity->id);
//        $this->assertIsNumeric($entity->id);
//        $this->assertSame($entity->getFirstName(), $command->getFirstName());
//        $this->assertSame($entity->getLastName(), $command->getLastName());
//        $this->assertSame($entity->getEmail(), $command->getEmail());
//    }
//    public function testHandlerRejectDuplicateEmail()
//    {
//        $command = new CreateUserCommand(
//            id: null,
//            firstName: UnitTestCase::FIRSTNAME,
//            lastName: UnitTestCase::LASTNAME,
//            email: UnitTestCase::EMAIL
//        );
//
//        $handler = $this->container->get(CreateUserCommandHandlerTest::class);
//
//
//        $handler->__invoke($command);
//
//        $this->expectException(EmailNotUniqueException::class);
//        $this->expectExceptionMessage('Email already exists');
//        $handler = $this->container->get(CreateUserCommandHandlerTest::class);
//    }
}
