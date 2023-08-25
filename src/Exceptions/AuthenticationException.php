<?php

namespace Retamayo\Absl\Exceptions;

/**
 * Class AuthenticationException
 * 
 * @package Retamayo\Absl\Exceptions
 */
class AuthenticationException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}