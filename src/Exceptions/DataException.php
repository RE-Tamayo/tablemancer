<?php

namespace Retamayo\Absl\Exceptions;

/**
 * Class DataException
 * 
 * @package Retamayo\Absl\Exceptions
 */
class DataException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}