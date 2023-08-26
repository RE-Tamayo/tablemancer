<?php

namespace Retamayo\Tablemancer\Exceptions;

/**
 * Class CrudExecutionException
 * 
 * @package Retamayo\Tablemancer\Exceptions
 */
class CrudExecutionException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}