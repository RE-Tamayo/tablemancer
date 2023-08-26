<?php

namespace Retamayo\Tablemancer\Exceptions;

/**
 * Class JsonException
 * 
 * @package Retamayo\Tablemancer\Exceptions
 */
class JsonException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}