<?php

namespace App\Support\Exceptions;

class InternalErrorException extends ExceptionBase
{
    private const CODE = 500;
    private const CATEGORY = 'internal_error';

    public function __construct($userMessage = "", $internalMessage = "", Throwable $previous = null)
    {
        parent::__construct($userMessage, $internalMessage, $previous);
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
        return [
            __('user-messages.internal-error')
        ];
    }
}
