<?php

namespace Retamayo\Absl;

use Retamayo\Absl\Classes\Schema;
use Retamayo\Absl\Classes\Table;
use Retamayo\Absl\Classes\Crud;
use Retamayo\Absl\Classes\Authentication;
use Retamayo\Absl\Classes\Validation;
use Retamayo\Absl\Classes\Filter;
use Retamayo\Absl\Classes\JsonApi;

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
    public function create(string $table, array $data, string|int|float|bool $primary = null): string
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        $lastId = $crud->create($data, $primary);
        unset($crud);
        return $lastId;
    }

    /**
     * Retrieves all records of the specified columns from the current table.
     * 
     * @see Crud
     */
    public function list(string $table, array $columns): array
    {
        $crud = new Crud($this->connection, $this->useTable($table));
        $data = $crud->list($columns);
        unset($crud);
        return $data;
    }

    /**
     * Retrieves a single record from the current table.
     * 
     * @see Crud
     */
    public function listSingle(string $table, array $columns, string $where, string|int|float|bool $whereValue): array
    { 
        $crud = new Crud($this->connection, $this->useTable($table));
        $data = $crud->listSingle($columns, $where, $whereValue);
        unset($crud);
        return $data;
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

    /**
     * Authenticates a user.
     * 
     * @see Authentication
     */
    public function authenticate(array $config, string $username, string $password): bool
    {
        $auth = new Authentication($this->connection, $this->useTable($config['table']), $config['userColumn'], $config['tokenColumn'], $config['session']);
        $isAuth = $auth->authenticate($username, $password);
        unset($auth);
        return $isAuth;
    }

    /**
     * Checks if a record exists.
     * 
     * @see Validation
     */
    public function checkRecord(string $table, string $checkColumn, string|int|float|bool $checkValue): bool
    {
        $validation = new Validation($this->connection, $this->useTable($table));
        $doesExists = $validation->checkRecord($checkColumn, $checkValue);
        unset($validation);
        return $doesExists;
    }

    /**
     * Sanitizes a variable.
     * 
     * @see Validation
     */
    public function sanitizeVariable(string|int|float|bool $var): string|int|float|bool
    {
        $validation = new Validation(null, null);
        $var = $validation->sanitizeVariable($var);
        unset($validation);
        return $var;
    }

    /**
     * Sanitizes an array.
     * 
     * @see Validation
     */
    public function sanitizeArray(array $var): array
    {
        $validation = new Validation(null, null);
        $arr = $validation->sanitizeArray($var);
        unset($validation);
        return $arr;
    }

    /**
     * Searches for records.
     * 
     * @see Filter
     */
    public function search(string|int|float|bool $searchQuery, array $data): array
    {
        $filter = new Filter();
        unset($filter);
        return $filter->search($searchQuery, $data);
    }

    /**
     * Paginates records.
     * 
     * @see Filter
     */
    public function paginate(int $page, int $perPage, array $data): array
    {
        $filter = new Filter();
        unset($filter);
        return $filter->paginate($page, $perPage, $data);
    }

    /**
     * Creates a new record on the current table, takes a JSON string.
     * 
     * @see JsonApi
     */
    public function createJson(string $json): string
    {
        $jsonData = json_decode($json, true);
        $api = new JsonApi($this->connection, $this->useTable($jsonData['table']));
        $lastId = $api->createJson($json);
        unset($api);
        return $lastId;
    }

    /**
     * Lists all records on the current table, takes a JSON string.
     * 
     * @see JsonApi
     */
    public function listJson(string $json): string
    {
        $jsonData = json_decode($json, true);
        $api = new JsonApi($this->connection, $this->useTable($jsonData['table']));
        $data = $api->listJson($json);
        unset($api);
        return $data;
    }

    /**
     * Lists a single record on the current table, takes a JSON string.
     * 
     * @see JsonApi
     */
    public function listSingleJson(string $json): string
    {
        $jsonData = json_decode($json, true);
        $api = new JsonApi($this->connection, $this->useTable($jsonData['table']));
        $data = $api->listSingleJson($json);
        unset($api);
        return $data;
    }

    /**
     * Updates a record on the current table, takes a JSON string.
     * 
     * @see JsonApi
     */
    public function updateJson(string $json): void
    {
        $jsonData = json_decode($json, true);
        $api = new JsonApi($this->connection, $this->useTable($jsonData['table']));
        $api->updateJson($json);
        unset($api);
    }

    /**
     * Deletes a record on the current table, takes a JSON string.
     * 
     * @see JsonApi
     */
    public function deleteJson(string $json): void
    {
        $jsonData = json_decode($json, true);
        $api = new JsonApi($this->connection, $this->useTable($jsonData['table']));
        $api->deleteJson($json);
        unset($api);
    }
}
