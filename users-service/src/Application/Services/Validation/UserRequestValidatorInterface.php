<?php

namespace App\Application\Services\Validation;

use App\Infrastructure\Http\Requests\UserRequestInterface;
use App\Infrastructure\Http\Responses\Errors\ErrorResponse;

interface UserRequestValidatorInterface
{
    public function validate(UserRequestInterface $request): ?ErrorResponse;
}
