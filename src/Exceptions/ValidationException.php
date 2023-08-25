<?php

namespace Retamayo\Absl\Exceptions;

/**
 * Class ValidationException
 * 
 * @package Retamayo\Absl\Exceptions
 */
class ValidationException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}