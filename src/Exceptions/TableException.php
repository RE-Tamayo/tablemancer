<?php

namespace Retamayo\Absl\Exceptions;

/**
 * Class TableException
 * 
 * @package Retamayo\Absl\Exceptions
 */
class TableException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}