<?php

namespace Retamayo\Absl\Exceptions;

/**
 * Class JsonException
 * 
 * @package Retamayo\Absl\Exceptions
 */
class JsonException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}