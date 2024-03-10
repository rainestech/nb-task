<?php

namespace App\Infrastructure\Http\Responses\Errors;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

abstract class BaseErrorResponse
{

    protected function send(): JsonResponse
    {
        $response = [
            'errors' => $this->getErrors(),
            'message' => $this->getMessage(),
            'status' => $this->getStatusCode()
        ];
        return new JsonResponse($response, $this->getStatusCode());
    }
}
