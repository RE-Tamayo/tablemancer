<?php

namespace Retamayo\Absl\Classes;

/**
 * Class Schema
 * 
 * @package Retamayo\Absl\Classes
 */
class Schema
{
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
     */
    public function useTable(string $name): Table
    {
        if (array_key_exists($name, $this->tables)) {
            $this->currentTable = $name;
            return $this->tables[$this->currentTable];
        } else {
            throw new \Exception('Table not found');
            exit();
        }
    }
}
