<?php

namespace Retamayo\Tablemancer\Classes;

/**
 * Class Table
 * 
 * @package Retamayo\Tablemancer\Classes
 */
class Table
{
    /**
     * @var string name
     * @var array columns
     * @var string primary
     */
    public function __construct(
        public string $name,
        public array $columns,
        public string $primary,
        public array $sensitive
    ) {}
}
