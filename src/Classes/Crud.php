<?php

namespace Retamayo\Absl\Classes;

use PDO;
use Retamayo\Absl\Exceptions\CrudExecutionException;
use Retamayo\Absl\Traits\Query;
use Retamayo\Absl\Traits\ExceptionHandler;

class Crud
{
    use Query;
    use ExceptionHandler;

    public function __construct(
        private \PDO $connection,
        private Table $table
    ) {}

    public function create(array $data): void
    {
        $keys = $this->extractKeysAndValues($data)["keys"];
        $values = $this->extractKeysAndValues($data)["values"];
        $query =  $this->insertQuery($this->table->name, $keys);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute($values)) {
                throw new CrudExecutionException("Failed to exceute create query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
        }
    }

    public function list(array $columns): array
    {
        $query = $this->listQuery($this->table->name, $columns);
        $statement = $this->connection->prepare($query);
        try {
            if ($statement->execute()) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new CrudExecutionException("Failed to exceute list query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
        } 
        return $data;
    }

    public function listSingle(array $columns, string $where, string|int|float|bool $whereValue): array
    {
        $query = $this->listSingleQuery($this->table->name, $columns, $where);
        $statement = $this->connection->prepare($query);
        try {
            if ($statement->execute([$whereValue])) {
                $data = $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new CrudExecutionException("Failed to exceute listSingle query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
        } 
        return $data;
    }

    public function update(array $data, string $where, string|int|float|bool $whereValue): void
    {
        $keys = $this->extractKeysAndValues($data)["keys"];
        $values = $this->extractKeysAndValues($data)["values"];
        $query = $this->updateQuery($this->table->name, $keys, $where);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$values, $whereValue])) {
                throw new CrudExecutionException("Failed to exceute update query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
        }
    }

    public function delete(string $where, string|int|float|bool $whereValue): void
    {
        $query = $this->deleteQuery($this->table->name, $where);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$whereValue])) {
                throw new CrudExecutionException("Failed to exceute delete query");
            }
        } catch (CrudExecutionException $e) {
            $this->formatException($e);
        }
    }
}
