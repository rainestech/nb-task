<?php

namespace App\Infrastructure\Http\Responses;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

abstract class BaseResponse
{

    public function __construct()
    {

    }

    public abstract function respond(): JsonResponse;
}
