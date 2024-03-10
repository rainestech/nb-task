<?php

namespace App\Tests\Unit\Infrastructure\Http\Requests;

use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;
use App\Infrastructure\Http\Requests\UserCreateRequest;
use App\Tests\Unit\UnitTestCase;

class UserCreateRequestTest extends UnitTestCase
{
    public function testGettersReturnCorrectData()
    {
        $request = new UserCreateRequest(
            firstName: self::FIRSTNAME,
            lastName: self::LASTNAME,
            email: self::EMAIL
        );

        $this->assertSame(self::FIRSTNAME, $request->getFirstName());
        $this->assertSame(self::LASTNAME, $request->getLastName());
        $this->assertSame(self::EMAIL, $request->getEmail());
    }

    public function testSettersSetCorrectData()
    {
        $request = new UserCreateRequest('', '', '');
        $request->setEmail(self::EMAIL);
        $request->setFirstName(self::FIRSTNAME);
        $request->setLastName(self::LASTNAME);

        $this->assertSame(self::FIRSTNAME, $request->getFirstName());
        $this->assertSame(self::LASTNAME, $request->getLastName());
        $this->assertSame(self::EMAIL, $request->getEmail());
    }

    public function testToCommandReturnCorrectType()
    {
        $request = new UserCreateRequest(
            firstName: self::FIRSTNAME,
            lastName: self::LASTNAME,
            email: self::EMAIL
        );

        $this->assertTrue($request->toCommand() instanceof CreateUserCommand);
    }
}
