<?php

namespace Retamayo\Absl\Classes;

use PDO;
use Retamayo\Absl\Exceptions\CrudExecutionException;
use Retamayo\Absl\Traits\QueryBuilder;
use Retamayo\Absl\Traits\SensitiveDataMiddleware;
use Retamayo\Absl\Traits\ExceptionFormatter;

/**
 * Class Crud
 * 
 * @package Retamayo\Absl\Classes
 */
class Crud
{
    /**
     * @trait QueryBuilder
     * @trait ExceptionFormatter
     * @trait SensitiveDataMiddleware
     */
    use QueryBuilder;
    use SensitiveDataMiddleware;
    use ExceptionFormatter;

    /**
     * @var PDO $connection
     * @var Table $table
     */
    public function __construct(
        private \PDO $connection,
        private Table $table
    ) {}

    /**
     * Creates a new record on the current table.
     * 
     * @param array $data
     * @param string|int|float|bool $primary
     * 
     * @return void
     * 
     * @throws CrudExecutionException
     */
    public function create(array $data, string|int|float|bool $primary = null): void
    {
        if (!is_null($primary)) {
            array_unshift($this->table->columns, $this->table->primary);
            array_unshift($data, $primary);
        }
        $query =  $this->insertQuery($this->table->name, $this->table->columns);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute(array_values($data))) {
                throw new CrudExecutionException("Failed to execute create query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Retrieves all records of the specified columns from the current table.
     * 
     * @param array $columns
     * 
     * @return array
     * 
     * @throws CrudExecutionException
     */
    public function list(array $columns): array
    {
        $query = $this->listQuery($this->table->name, $columns);
        $statement = $this->connection->prepare($query);
        try {
            if ($statement->execute()) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                $data = $this->filterSensitiveData($this->table->sensitive, $data, "2D");
                return $data;
            } else {
                throw new CrudExecutionException("Failed to execute list query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
            exit();
        }
    }


    /**
     * Retrieves a single record from the current table.
     * 
     * @param array $columns
     * @param string $where
     * @param string|int|float|bool $whereValue
     * 
     * @return array
     * 
     * @throws CrudExecutionException
     */
    public function listSingle(array $columns, string $where, string|int|float|bool $whereValue): array
    {
        $query = $this->listSingleQuery($this->table->name, $columns, $where);
        $statement = $this->connection->prepare($query);
        try {
            if ($statement->execute([$whereValue])) {
                $data = $statement->fetch(PDO::FETCH_ASSOC);
                $data = $this->filterSensitiveData($this->table->sensitive, $data, "1D");
                return $data;
            } else {
                throw new CrudExecutionException("Failed to execute listSingle query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Updates a record on the current table.
     * 
     * @param array $data
     * @param string $where
     * @param string|int|float|bool $whereValue
     * @param string|int|float|bool $primary
     * 
     * @return void
     * 
     * @throws CrudExecutionException
     */
    public function update(array $data, string $where, string|int|float|bool $whereValue, string|int|float|bool $primary = null): void
    {
        if (!is_null($primary)) {
            array_unshift($this->table->columns, $this->table->primary);
            array_unshift($data, $primary);
        }
        $query = $this->updateQuery($this->table->name, $this->table->columns, $where);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([...array_values($data), $whereValue])) {
                throw new CrudExecutionException("Failed to execute update query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Deletes a record from the current table.
     * 
     * @param string $where
     * @param string|int|float|bool $whereValue
     * 
     * @return void
     * 
     * @throws CrudExecutionException
     */
    public function delete(string $where, string|int|float|bool $whereValue): void
    {
        $query = $this->deleteQuery($this->table->name, $where);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$whereValue])) {
                throw new CrudExecutionException("Failed to execute delete query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
            exit();
        }
    }
}
