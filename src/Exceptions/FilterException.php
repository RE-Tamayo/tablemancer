<?php

namespace Retamayo\Tablemancer\Exceptions;

/**
 * Class FilterException
 * 
 * @package Retamayo\Tablemancer\Exceptions
 */
class FilterException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}