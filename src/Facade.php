<?php

namespace Retamayo\Absl;

use Retamayo\Absl\Classes\Schema;
use Retamayo\Absl\Classes\Table;
use Retamayo\Absl\Classes\Crud;

class Facade
{
    private Schema $schema;
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
        $this->schema = Schema::getInstance();
    }

    public function addTable(string $name, Table $table): void
    {
        $this->schema->addTable($name, $table);
    }

    private function useTable(string $name): Table
    {
        return $this->schema->useTable($name);
    }

    public function create(string $table, array $data): void
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        $crud->create($data);
        unset($crud);
    }

    public function list(string $table, array $columns): void
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        print_r($crud->list($columns));
        unset($crud);
    }

    public function listSingle(string $table, array $columns, string $where, string|int|float|bool $whereValue): void
    { 
        $crud = new Crud($this->connection, $this->useTable($table));
        print_r($crud->listSingle($columns, $where, $whereValue));
        unset($crud);
    }

    public function update(string $table, array $data, string $where, string|int|float|bool $whereValue): void
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        $crud->update($data, $where, $whereValue);
        unset($crud);
    }

    public function delete(string $table, string $where, string|int|float|bool $whereValue): void
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        $crud->delete($where, $whereValue);
        unset($crud);
    }
}
