<?php

namespace App\Infrastructure\Messaging\Commands;

use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;

class UserCreatedCommand
{
    private CreateUserCommand $data;

    public function __construct(CreateUserCommand $data)
    {
        $this->data = $data;
    }

    public function getData(): CreateUserCommand
    {
        return $this->data;
    }

    public function __serialize(): array
    {
        return ['data' => [
            'id' => $this->data->getId(),
            'firstName' => $this->data->getFirstName(),
            'lastName' => $this->data->getLastName(),
            'email' => $this->data->getEmail(),
        ]];
    }

    public function __unserialize(array $data): void
    {
        $this->data = new CreateUserCommand(
            $data['data']['id'],
            $data['data']['firstName'],
            $data['data']['lastName'],
            $data['data']['email'],
        );
    }
}
