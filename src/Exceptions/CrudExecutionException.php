<?php

namespace Retamayo\Absl\Exceptions;

/**
 * Class CrudExecutionException
 * 
 * @package Retamayo\Absl\Exceptions
 */
class CrudExecutionException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}