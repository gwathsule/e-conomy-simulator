<?php

namespace App\Support\Exceptions;

class ValidationException extends ExceptionBase
{
    private const CODE = 422;
    private const CATEGORY = 'validation_error';
    /**
     * @var array
     */
    private $errors;

    public function __construct(array $errors, $userMessage = "", $internalMessage = "", $previous = null)
    {
        parent::__construct($userMessage, $internalMessage, $previous);
        $this->errors = $errors;
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
