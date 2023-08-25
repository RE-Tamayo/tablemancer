<?php

namespace Retamayo\Absl\Exceptions;

/**
 * Class FilterException
 * 
 * @package Retamayo\Absl\Exceptions
 */
class FilterException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct(message: $message);
    }

}