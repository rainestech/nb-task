<?php

namespace App\Infrastructure\Messaging\Commands;

use App\Application\Services\Dto\UsersDto;

class UserCreatedCommand
{
    private UsersDto $data;

    public function __construct(UsersDto $data)
    {
        $this->data = $data;
    }

    public function getData(): UsersDto
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
        $this->data = new UsersDto(
            $data['data']['id'],
            $data['data']['firstName'],
            $data['data']['lastName'],
            $data['data']['email'],
        );
    }
}
