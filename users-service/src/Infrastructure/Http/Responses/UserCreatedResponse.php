<?php

namespace App\Infrastructure\Http\Responses;

use App\Domain\Entity\UserEntity;
use App\Infrastructure\Domain\Commands\Users\CreateUserCommand;
use App\Infrastructure\Transformers\UserDataTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class UserCreatedResponse extends BaseResponse
{
    private CreateUserCommand $data;

    public function __construct(UserEntity $entity)
    {
        parent::__construct();
        $this->data = UserDataTransformer::toCommand($entity);
    }

    public function respond(): JsonResponse
    {
        $data = [
            'id' => $this->data->getId(),
            'firstName' => $this->data->getFirstName(),
            'lastName' => $this->data->getLastName(),
            'email' => $this->data->getEmail()
        ];
        return new JsonResponse($data, Response::HTTP_CREATED);
    }
}
