<?php

namespace App\Infrastructure\Messaging\Commands;

use Monolog\Attribute\WithMonologChannel;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
#[WithMonologChannel('notifications')]
class UserCreatedCommandHandler
{
    public function __construct(private LoggerInterface $logger)
    {

    }

    public function __invoke(UserCreatedCommand $message): void
    {
        $this->logger->info(json_encode([
            'body' => [
                'id' => $message->getData()->getId(),
                'firstName' => $message->getData()->getFirstName(),
                'lastName' => $message->getData()->getLastName(),
                'email' => $message->getData()->getEmail(),
            ],
        ]));
    }
}
