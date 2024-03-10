<?php

namespace App\Infrastructure\Messaging\Serializer;

use App\Application\Services\Dto\UsersDto;
use App\Infrastructure\Messaging\Commands\UserCreatedCommand;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class MessageCommandSerializer implements SerializerInterface
{
    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();

        if (!$message instanceof UserCreatedCommand) {
            throw new \InvalidArgumentException('MessageCommandSerializer supports only instances of UserCreatedCommand');
        }

        $data = $message->getData();

        return [
            'body' => json_encode([
                'id' => $data->getId(),
                'firstName' => $data->getFirstName(),
                'lastName' => $data->getLastName(),
                'email' => $data->getEmail(),
            ]),
            'headers' => ['type' => UserCreatedCommand::class],
        ];
    }

    public function decode(array $encodedEnvelope): Envelope
    {
        $data = json_decode($encodedEnvelope['body'], true);

        if ($encodedEnvelope['headers']['type'] !== UserCreatedCommand::class) {
            throw new \InvalidArgumentException('MessageCommandSerializer supports only instances of UserCreatedCommand');
        }

        $userDto = new UsersDto(
            $data['id'],
            $data['firstName'],
            $data['lastName'],
            $data['email']
        );

        $message = new UserCreatedCommand($userDto);

        return new Envelope($message);
    }
}
