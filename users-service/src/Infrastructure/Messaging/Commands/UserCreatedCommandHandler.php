<?php

namespace App\Infrastructure\Messaging\Commands;

use Monolog\Attribute\WithMonologChannel;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UserCreatedCommandHandler
{
    public function __construct()
    {

    }

    public function __invoke(UserCreatedCommand $message): void
    {
        //
    }
}
