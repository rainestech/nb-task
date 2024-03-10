<?php

namespace App\Tests\Unit;


use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UnitTestCase extends WebTestCase
{
    protected KernelBrowser $client;
    protected const METHOD = 'POST';
    protected const URI = '/api/users/test';

    public const EMAIL = 'sample@email.com';
    public const LASTNAME = 'Doe';
    public const FIRSTNAME = 'John';

    protected SerializerInterface $serializer;
    protected ValidatorInterface $validator;

    protected const USER_ID = 1234;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();

        $container = static::getContainer();
        $this->serializer = $container->get(SerializerInterface::class);
        $this->validator = $container->get(ValidatorInterface::class);
    }
}
