<?php

namespace Retamayo\Tablemancer\Classes;

use Retamayo\Tablemancer\Exceptions\TableException;
use Retamayo\Tablemancer\Traits\ExceptionFormatter;

/**
 * Class Schema
 * 
 * @package Retamayo\Tablemancer\Classes
 */
class Schema
{
    /**
     * @trait ExceptionFormatter
     */
    use ExceptionFormatter;

    /**
     * @var Schema
     * @var string $currentTable
     * @var array $tables
     */
    private static ?Schema $instance = null;
    private string $currentTable;
    private array $tables = [];

    private function __construct() {}

    /**
     * Returns the current instance.
     * 
     * @return Schema
     */
    public static function getInstance(): Schema
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Adds a new table to the schema.
     * 
     * @param string $name
     * 
     * @return void
     */
    public function addTable(string $name, Table $table): void
    {
        $this->tables[$name] = $table;
    }

    /**
     * Returns the current table.
     * 
     * @param string $name
     * 
     * @return Table
     * 
     * @throws TableException
     */
    public function useTable(string $name): Table
    {
        try {
            if (array_key_exists($name, $this->tables)) {
                $this->currentTable = $name;
                return $this->tables[$this->currentTable];
            } else {
                throw new TableException('Table not found');
            }
        } catch (TableException $e) {
            $this->formatException($e);
            exit();
        }
    }
}
