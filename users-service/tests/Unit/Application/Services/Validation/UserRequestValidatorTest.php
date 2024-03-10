<?php

namespace App\Tests\Unit\Application\Services\Validation;


use App\Application\Services\Validation\UserRequestValidator;
use App\Infrastructure\Http\Requests\UserCreateRequest;
use App\Infrastructure\Http\Responses\Errors\ErrorResponse;
use App\Tests\Unit\UnitTestCase;

class UserRequestValidatorTest extends UnitTestCase
{
    public function testValidDataReturnsNull()
    {
        $request = new UserCreateRequest(
            firstName: self::FIRSTNAME,
            lastName: self::LASTNAME,
            email: self::EMAIL
        );
        $validator = new UserRequestValidator($this->validator);
        $this->assertNull($validator->validate($request));
    }

    public function testInValidDataReturnsResponse()
    {
        $request = new UserCreateRequest(
            "",
            self::LASTNAME,
            self::EMAIL
        );

        $validator = new UserRequestValidator($this->validator);
        $this->assertNotNull($validator->validate($request));
        $this->assertTrue($validator->validate($request) instanceof ErrorResponse);
        $this->assertSame(422, $validator->validate($request)->getStatusCode());
    }
}
