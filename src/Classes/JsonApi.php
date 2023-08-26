<?php

namespace Retamayo\Absl\Classes;

use Retamayo\Absl\Traits\QueryBuilder;
use Retamayo\Absl\Traits\ExceptionFormatter;

/**
 * Class JsonApi
 * 
 * @package Retamayo\Absl\Classes
 */
class JsonApi
{
     /**
     * @trait QueryBuilder
     * @trait ExceptionFormatter
     */
    use QueryBuilder;
    use ExceptionFormatter;

    /**
     * @var PDO $connection
     * @var Table $table
     */
    public function __construct(
        private \PDO $connection,
        private Table $table
    ) {}

}
