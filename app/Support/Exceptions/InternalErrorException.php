<?php

namespace App\Support\Exceptions;

class InternalErrorException extends ExceptionBase
{
    private const CODE = 500;
    private const CATEGORY = 'internal_error';
    protected $userMessage;

    public function __construct($userMessage = "", $internalMessage = "", Throwable $previous = null)
    {
        $this->userMessage = $userMessage;
        parent::__construct($internalMessage, $this->getErrorCode(), $previous);
    }

    function getErrorCode(): int
    {
        return self::CODE;
    }

    function getCategory(): string
    {
        return self::CATEGORY;
    }

    function getErrors(): array
    {
        return [];
    }
}
