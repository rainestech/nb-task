<?php

namespace App\Infrastructure\Domain\Exception;

class EmailNotUniqueException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
