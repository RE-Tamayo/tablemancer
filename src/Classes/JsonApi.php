<?php

namespace Retamayo\Absl\Classes;

use Retamayo\Absl\Traits\QueryBuilder;
use Retamayo\Absl\Traits\ExceptionFormatter;
use Retamayo\Absl\Exceptions\JsonException;
use Retamayo\Absl\Traits\SensitiveDataMiddleware;

/**
 * Class JsonApi
 * 
 * @package Retamayo\Absl\Classes
 */
class JsonApi
{
     /**
     * @trait QueryBuilder
     * @trait ExceptionFormatter
     * @trait SensitiveDataMiddleware
     */
    use QueryBuilder;
    use ExceptionFormatter;
    use SensitiveDataMiddleware;

    /**
     * @var PDO $connection
     * @var Table $table
     */
    public function __construct(
        private \PDO $connection,
        private Table $table
    ) {}
    
    /**
     * Creates a new record on the current table, takes a JSON string.
     * 
     * @param string $json
     * 
     * @return string
     * 
     * @throws JsonException
     */
    public function createJson(string $json): string
    {   
        $jsonData = json_decode($json, true);
        if (!is_null($jsonData['primaryValue'])) {
            array_unshift($this->table->columns, $this->table->primary);
            array_unshift($jsonData['data'], $jsonData['primaryValue']);
        }
        $query = $this->insertQuery($jsonData['table'], $this->table->columns);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute(array_values($jsonData['data']))) {
                throw new JsonException("Failed to execute create query");
            } else {
                return $this->connection->lastInsertId();
            }
        } catch (JsonException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Lists all records on the current table, takes a JSON string.
     * 
     * @param string $json
     * 
     * @return string
     * 
     * @throws JsonException
     */
    public function listJson(string $json): string
    {
        $jsonData = json_decode($json, true);
        $query = $this->listQuery($jsonData['table'], $jsonData['columns']);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute()) {
                throw new JsonException("Failed to execute list query");
            } else {
                $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
                $data = $this->filterSensitiveData($this->table->sensitive, $data, "2D");
                return json_encode($data);
            }
        } catch (JsonException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Retrieves a single record on the current table, takes a JSON string.
     * 
     * @param string $json
     * 
     * @return string
     * 
     * @throws JsonException
     */
    public function listSingleJson(string $json): string
    {
        $jsonData = json_decode($json, true);
        $query = $this->listSingleQuery($jsonData['table'], $jsonData['columns'], $jsonData['where']);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$jsonData['whereValue']])) {
                throw new JsonException("Failed to execute listSingle query");
            } else {
                $data = $statement->fetch(\PDO::FETCH_ASSOC);
                $data = $this->filterSensitiveData($this->table->sensitive, $data, "1D");
                return json_encode($data);
            }
        } catch (JsonException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Updates a record on the current table, takes a JSON string.
     * 
     * @param string $json
     * 
     * @return void
     * 
     * @throws JsonException
     */
    public function updateJson(string $json): void
    {
        $jsonData = json_decode($json, true);
        if (!is_null($jsonData['primaryValue'])) {
            array_unshift($this->table->columns, $this->table->primary);
            array_unshift($jsonData['data'], $jsonData['primaryValue']);
        }
        $query = $this->updateQuery($jsonData['table'], $this->table->columns, $jsonData['where']);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([...array_values($jsonData['data']), $jsonData['whereValue']])) {
                throw new JsonException("Failed to execute update query");
            }
        } catch (JsonException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Deletes a record on the current table, takes a JSON string.
     * 
     * @param string $json
     * 
     * @return void
     * 
     * @throws JsonException
     */
    public function deleteJson(string $json): void
    {
        $jsonData = json_decode($json, true);
        $query = $this->deleteQuery($jsonData['table'], $jsonData['where']);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$jsonData['whereValue']])) {
                throw new JsonException("Failed to execute delete query");
            }
        } catch (JsonException $e) {
            $this->formatException($e);
            exit();
        }
    }
} 
