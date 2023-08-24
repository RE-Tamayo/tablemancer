<?php

namespace Retamayo\Absl;

use Retamayo\Absl\Classes\Schema;
use Retamayo\Absl\Classes\Table;
use Retamayo\Absl\Classes\Crud;

/**
 * Class Facade
 * 
 * @package Retamayo\Absl 
 */
class Facade
{
    /**
     * @var Schema
     * @var \PDO
     */
    private Schema $schema;
    private \PDO $connection;

    /**
     * @param \PDO $connection
     * 
     * @return void
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
        $this->schema = Schema::getInstance();
    }

    /**
     * Adds a new table to the schema.
     * 
     * @see Schema
     */
    public function addTable(string $name, Table $table): void
    {
        $this->schema->addTable($name, $table);
    }

    /**
     * Returns the current instance.
     * 
     * @see Schema
     */
    private function useTable(string $name): Table
    {
        return $this->schema->useTable($name);
    }

    /**
     * Creates a new record on the current table.
     * 
     * @see Crud
     */
    public function create(string $table, array $data, string|int|float|bool $primary = null): void
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        $crud->create($data, $primary);
        unset($crud);
    }

    /**
     * Retrieves all records of the specified columns from the current table.
     * 
     * @see Crud
     */
    public function list(string $table, array $columns): void
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        print_r($crud->list($columns));
        unset($crud);
    }

    /**
     * Retrieves a single record from the current table.
     * 
     * @see Crud
     */
    public function listSingle(string $table, array $columns, string $where, string|int|float|bool $whereValue): void
    { 
        $crud = new Crud($this->connection, $this->useTable($table));
        print_r($crud->listSingle($columns, $where, $whereValue));
        unset($crud);
    }

    /**
     * Updates a record on the current table.
     * 
     * @see Crud
     */
    public function update(string $table, array $data, string $where, string|int|float|bool $whereValue, string|int|float|bool $primary = null): void
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        $crud->update($data, $where, $whereValue, $primary);
        unset($crud);
    }

    /**
     * Deletes a record on the current table.
     * 
     * @see Crud
     */
    public function delete(string $table, string $where, string|int|float|bool $whereValue): void
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        $crud->delete($where, $whereValue);
        unset($crud);
    }
}
