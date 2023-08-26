<?php

namespace Retamayo\Tablemancer\Exceptions;

/**
 * Class TableException
 * 
 * @package Retamayo\Tablemancer\Exceptions
 */
class TableException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}