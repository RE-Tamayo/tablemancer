<?php

namespace Retamayo\Absl\Classes;

use Retamayo\Absl\Traits\QueryBuilder;
use Retamayo\Absl\Traits\ExceptionHandler;

/**
 * Class Filter
 * 
 * @package Retamayo\Absl\Classes
 */
class Filter
{
     /**
     * @trait QueryBuilder
     * @trait ExceptionHandler
     */
    use QueryBuilder;
    use ExceptionHandler;

    /**
     * @var PDO $connection
     * @var Table $table
     */
    public function __construct(
        private \PDO $connection,
        private Table $table
    ) {}

}
