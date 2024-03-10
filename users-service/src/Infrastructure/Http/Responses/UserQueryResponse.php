<?php

namespace App\Infrastructure\Http\Responses;

use App\Domain\Entity\UserEntity;
use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;
use App\Infrastructure\Transformers\UserDataTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class UserQueryResponse extends BaseResponse
{
    /** @var array<CreateUserCommand> $data */
    private array $data;

    public function __construct(SerializerInterface $serializer, UserEntity ...$entity)
    {
        parent::__construct($serializer);
        $this->populateData($entity);
    }

    public function respond(): JsonResponse
    {
        $response = $this->serializer->serialize($this->data, 'json');
        return new JsonResponse($response, Response::HTTP_OK);
    }

    /** @var array<CreateUserCommand> */
    private function populateData(array $entity): void
    {
        $this->data = [];
        foreach ($entity as $user) {
            $this->data[] = UserDataTransformer::toCommand($user);
        }
    }
}
