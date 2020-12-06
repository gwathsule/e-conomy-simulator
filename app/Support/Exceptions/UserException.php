<?php

namespace App\Support\Exceptions;

class UserException extends ExceptionBase
{
    private const CODE = 400;
    private const CATEGORY = 'user_error';
    /**
     * @var array
     */
    private $errors;

    public function __construct($userMessage = "", $internalMessage = "", $previous = null)
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
        return collect($this->errors)->map(function ($item, $key) {
            return $item[0];
        })->toArray();
    }
}