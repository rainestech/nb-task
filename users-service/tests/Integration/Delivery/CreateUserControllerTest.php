<?php

namespace App\Tests\Integration\Delivery;

use App\Tests\Integration\IntegrationTestCase;

class CreateUserControllerTest extends IntegrationTestCase
{
    /**
     * @dataProvider provideCreateUsers
     */
    public function testCreateUsersSuccessful(array $request, array $expected): void
    {
        $this->makeRequest($request);
        $response = $this->client->getResponse();
        $decodedResponse = $this->decodeResponse($response);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertArrayHasKey("id", $decodedResponse);

        // id is auto generated and incremented by 1 for each run
        unset($decodedResponse['id']);
        $this->assertSame($expected, $decodedResponse);
    }

    /**
     * @dataProvider provideInvalidCreateUsersRequest
     */
    public function testCreateUsersFailed(array $request, array $data): void
    {
        $this->makeRequest($request);
        $response = $this->client->getResponse();
        $this->assertEquals(422, $response->getStatusCode());
        $this->assertSame($data, $this->decodeResponse($response));
    }

    public function provideCreateUsers(): array
    {
        return [
            'validData' => [
                'request' => [
                    'firstName' => 'test',
                    'lastName' => 'test',
                    'email' => 'test@test.com',
                ],
                'expected' => [
                    'firstName' => 'test',
                    'lastName' => 'test',
                    'email' => 'test@test.com',
                ]
            ]
        ];
    }

    public function provideInvalidCreateUsersRequest(): array
    {
        return [
            'invalidEmail' => [
                'request' => [
                    'firstName' => 'test',
                    'lastName' => 'test',
                    'email' => 'test',
                ],
                'expected' => [
                    "errors" => [
                        [
                            "property" => "email",
                            "value" => "test",
                            "message" => "Email is not valid"
                        ]
                    ],
                    "message" => "Validation failed",
                    "status" => 422
                ]
            ],

            'invalidFirstName' => [
                'request' => [
                    'firstName' => '',
                    'lastName' => 'test',
                    'email' => 'test@test.com',
                ],
                'expected' => [
                    "errors" => [
                        [
                            "property" => "firstName",
                            "value" => "",
                            "message" => "First name is required"
                        ],
                        [
                            "property" => "firstName",
                            "value" => "",
                            "message" => "First name minimum length is 2"
                        ],
                    ],
                    "message" => "Validation failed",
                    "status" => 422
                ]
            ],

            'invalidLastName' => [
                'request' => [
                    'firstName' => 'test',
                    'lastName' => '',
                    'email' => 'test@test.com',
                ],
                'expected' => [
                    "errors" => [
                        [
                            "property" => "lastName",
                            "value" => "",
                            "message" => "Last name is required"
                        ],
                        [
                            "property" => "lastName",
                            "value" => "",
                            "message" => "Last name minimum length is 2"
                        ],
                    ],
                    "message" => "Validation failed",
                    "status" => 422
                ]
            ],

            'emptyValues' => [
                'request' => [
                    'firstName' => '',
                    'lastName' => '',
                    'email' => '',
                ],
                'expected' => [
                    "errors" => [
                        [
                            "property" => "firstName",
                            "value" => "",
                            "message" => "First name is required"
                        ],
                        [
                            "property" => "firstName",
                            "value" => "",
                            "message" => "First name minimum length is 2"
                        ],
                        [
                            "property" => "lastName",
                            "value" => "",
                            "message" => "Last name is required"
                        ],
                        [
                            "property" => "lastName",
                            "value" => "",
                            "message" => "Last name minimum length is 2"
                        ],
                        [
                            "property" => "email",
                            "value" => "",
                            "message" => "Email is required"
                        ]
                    ],
                    "message" => "Validation failed",
                    "status" => 422
                ]
            ],

        ];
    }
}
