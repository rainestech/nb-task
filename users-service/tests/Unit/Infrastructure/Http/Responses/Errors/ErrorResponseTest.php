<?php

namespace App\tests\Unit\Infrastructure\Http\Responses\Errors;

use App\Infrastructure\Http\Responses\Errors\ErrorResponse;
use App\Tests\Unit\UnitTestCase;

class ErrorResponseTest extends UnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGettersReturnCorrectData()
    {
        $error = new ErrorResponse(200, 'success', []);

        $this->assertEquals(200, $error->getStatusCode());
        $this->assertEquals('success', $error->getMessage());
        $this->assertEquals([], $error->getErrors());
    }
}
