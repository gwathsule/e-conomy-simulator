<?php

namespace App\Support\Exceptions;

use Exception;

abstract class ExceptionBase extends Exception
{
    /**
     * @var string
     */
    protected $userMessage;

    public function __construct($userMessage = "", $internalMessage = "", Throwable $previous = null)
    {
        $this->userMessage = $userMessage;
        $internalMessage = $internalMessage ?: $userMessage;
        parent::__construct($internalMessage, $this->getErrorCode(), $previous);
    }

    public function getUserMessage(): string
    {
        return $this->userMessage;
    }

    abstract function getErrorCode(): int;

    /**
     * get error category
     * @return string
     */
    abstract function getCategory(): string;

    /**
     * get errors separated in array
     * @return array
     */
    abstract function getErrors(): array;
}
