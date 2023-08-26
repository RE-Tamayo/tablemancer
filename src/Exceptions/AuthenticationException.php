<?php

namespace Retamayo\Tablemancer\Exceptions;

/**
 * Class AuthenticationException
 * 
 * @package Retamayo\Tablemancer\Exceptions
 */
class AuthenticationException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}