<?php

namespace App\Tests\Functional\Infrastructure\Delivery;

use App\Infrastructure\Delivery\CreateUserController;
use App\Tests\Functional\FunctionalTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateUserControllerTest extends FunctionalTestCase
{
    protected CreateUserController $controller;

    public function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->getContainer()->get(CreateUserController::class);
    }

    public function testCreateUserControllerReturnsCreatedWithValidRequest()
    {
        $response = $this->controller->createUsers($this->sampleValidRequest());
        $this->assertTrue($response instanceof JsonResponse);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testCreateUserControllerReturnsBadRequestWithInValidRequest()
    {
        $response = $this->controller->createUsers($this->sampleInValidRequest());
        $this->assertTrue($response instanceof JsonResponse);
        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testCreateUserControllerReturnsBadRequestWithEmptyRequest()
    {
        $response = $this->controller->createUsers($this->emptyRequest());
        $this->assertTrue($response instanceof JsonResponse);
        $this->assertEquals(400, $response->getStatusCode());
    }
}
