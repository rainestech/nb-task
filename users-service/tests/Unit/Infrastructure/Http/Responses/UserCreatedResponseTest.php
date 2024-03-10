<?php

namespace App\Tests\Unit\Infrastructure\Http\Responses;

use App\Domain\Entity\UserEntity;
use App\Infrastructure\Http\Responses\UserCreatedResponse;
use App\Tests\Unit\UnitTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserCreatedResponseTest extends UnitTestCase
{
    public function testRespondReturnsJsonResponse()
    {
        $entity = new UserEntity(
            firstName: self::FIRSTNAME,
            lastName: self::LASTNAME,
            email: self::EMAIL
        );
        $entity->setId(1);
        $response = new UserCreatedResponse($entity);

        $this->assertTrue($response->respond() instanceof JsonResponse);
    }
}
