<?php

namespace App\Support\Exceptions;

class ValidationException extends ExceptionBase
{
    public const CODE = 422;
    /**
     * The validation errors.
     *
     * @var array
     */
    private $errors;

    public function __construct(array $errors, $userMessage = "", $internalMessage = "", $previous = null)
    {
        parent::__construct($userMessage, $internalMessage, $previous);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getCodeIdentifier()
    {
        return self::CODE;
    }
}