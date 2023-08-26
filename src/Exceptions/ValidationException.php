<?php

namespace Retamayo\Tablemancer\Exceptions;

/**
 * Class ValidationException
 * 
 * @package Retamayo\Tablemancer\Exceptions
 */
class ValidationException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}