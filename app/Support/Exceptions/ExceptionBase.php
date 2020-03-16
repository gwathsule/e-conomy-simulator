<?php

namespace App\Support\Exceptions;

use Exception;

class ExceptionBase extends Exception
{
    public const CATEGORY = 'user_error';

    /**
     * @var string
     */
    private $userMessage;

    public function __construct($userMessage = "", $internalMessage = "", Throwable $previous = null)
    {
        $this->userMessage = $userMessage;
        $internalMessage = $internalMessage ?: $userMessage;
        parent::__construct($internalMessage, $this->getCodeIdentifier(), $previous);
    }

    protected function getUserMessage(): string
    {
        return $this->userMessage;
    }

    protected function getCategory(): string
    {
        return self::CATEGORY;
    }
}