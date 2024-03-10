<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class IntegrationTestCase extends WebTestCase
{
    protected KernelBrowser $client;
    protected ContainerInterface $container;
    private const METHOD = 'POST';
    private const URI = '/api/users/create';

    public function setUp(): void
    {
        parent::setUp();
        $this->client = $this->createClient();
        $this->container = static::getContainer();
    }

    public function makeRequest(array $request): void
    {
        $this->client->jsonRequest(
            method: self::METHOD,
            uri: self::URI,
            parameters: $request,
            server: [
                'CONTENT_TYPE' => 'application/json'
            ]
        );
    }

    protected function decodeResponse(Response $response): ?array
    {
        return json_decode($response->getContent(), true);
    }
}
