<?php

namespace App\Application\Services\Validation;

use App\Infrastructure\Http\Requests\UserRequestInterface;
use App\Infrastructure\Http\Responses\Errors\ErrorResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserRequestValidator implements UserRequestValidatorInterface
{
    public function __construct(protected ValidatorInterface $validator)
    {
    }

    public function validate(UserRequestInterface $request): ?ErrorResponse
    {
        $errors = $this->validator->validate($request);

        if (count($errors) > 0) {
            return $this->returnErrorResponse($errors);
        }

        return null;
    }

    private function formatErrors(ConstraintViolationListInterface $errors): array
    {
        $formattedErrors = [];

        foreach ($errors as $message) {
            $formattedErrors[] = [
                'property' => $message->getPropertyPath(),
                'value' => $message->getInvalidValue(),
                'message' => $message->getMessage(),
            ];
        }

        return $formattedErrors;
    }

    private function returnErrorResponse(ConstraintViolationListInterface $errors): ErrorResponse
    {
        return new ErrorResponse(
            Response::HTTP_UNPROCESSABLE_ENTITY,
            'Validation failed',
            $this->formatErrors($errors)
        );
    }
}
