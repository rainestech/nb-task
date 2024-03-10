<?php

namespace App\Infrastructure\Http\Responses\Errors;

use Symfony\Component\HttpFoundation\JsonResponse;

class ErrorResponse extends BaseErrorResponse
{
    public function __construct(int $statusCode, string $message, array $errors = [])
    {
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->errors = $errors;
    }
    private int $statusCode;
    private string $message;
    private array $errors;

    public function sendErrors(): JsonResponse
    {
       return $this->send();
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
