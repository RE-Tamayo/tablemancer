<?php

namespace Retamayo\Absl\Classes;

use Retamayo\Absl\Exceptions\FilterException;
use Retamayo\Absl\Traits\QueryBuilder;
use Retamayo\Absl\Traits\ExceptionFormatter;

/**
 * Class Filter
 * 
 * @package Retamayo\Absl\Classes
 */
class Filter
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

    public function filter(string $filterColumn, string|int|float|bool $filterValue, string $filterOrder = "ASC", array $selectedColumns = []): void
    {
        if ($filterOrder == "DESC" || $filterOrder == "ASC") {
            throw new FilterException("Invalid filter order");
        }
        if ($selectedColumns == [] || empty($selectedColumns)) {
            $selectedColumns = "*";
        } else {
            $selectedColumns = rtrim(implode(", ", $selectedColumns), ", ");
        }
    }

}
