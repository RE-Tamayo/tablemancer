<?php

namespace Retamayo\Absl\Classes;

class Schema
{
    private static ?Schema $instance = null;

    private string $currentTable;
    private array $tables = [];

    private function __construct() {}

    public static function getInstance(): Schema
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addTable(string $name, Table $table): void
    {
        $this->tables[$name] = $table;
    }

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
