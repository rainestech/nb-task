<?php

namespace App\Tests\Functional;

use App\Tests\Integration\IntegrationTestCase;
use App\Tests\Unit\UnitTestCase;
use Symfony\Component\HttpFoundation\Request;

class FunctionalTestCase extends IntegrationTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function sampleValidRequest(): Request
    {
        return new Request(
          content: json_encode([
              'firstName' => UnitTestCase::FIRSTNAME,
              'lastName' => UnitTestCase::LASTNAME,
              'email' => UnitTestCase::EMAIL
          ])
        );
    }

    public function sampleInValidRequest(): Request
    {
        return new Request(
          content: json_encode([
              'firstName' => '',
              'lastName' => '',
              'email' => ''
          ])
        );
    }

    public function emptyRequest(): Request
    {
        return new Request();
    }
}
