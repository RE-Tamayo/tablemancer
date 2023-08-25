<?php

namespace Retamayo\Absl\Classes;

use Retamayo\Absl\Traits\QueryBuilder;
use Retamayo\Absl\Traits\ExceptionHandler;
use Retamayo\Absl\Exceptions\ValidationException;

/**
 * Class Validation
 * 
 * @package Retamayo\Absl\Classes
 */
class Validation
{
     /**
     * @trait QueryBuilder
     * @trait ExceptionHandler
     */
    use QueryBuilder;
    use ExceptionHandler;

    /**
     * @var ?PDO $connection
     * @var ?Table $table
     */
    public function __construct(
        private ?\PDO $connection,
        private ?Table $table
    ) {}

    /**
     * Checks if a record exists.
     * 
     * @param string $checkColumn
     * @param string|int|float|bool $checkValue
     * 
     * @return bool
     */
    public function checkRecord(string $checkColumn, string|int|float|bool $checkValue): bool
    {
        $query = $this->existsQuery($this->table->name, $checkColumn);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$checkValue])) {
                throw new ValidationException("Failed to execute check query");
            }
            $data = $statement->fetch(\PDO::FETCH_ASSOC);
            if (empty($data)) {
                return false;
            } else {
                return true;
            }
        } catch (ValidationException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Sanitizes a variable.
     * 
     * @param string|int|float|bool $var
     * 
     * @return string|int|float|bool
     */
    public function sanitizeVariable(string|int|float|bool $var): string|int|float|bool
    {
        $type = gettype($var);
        $var = match ($type) {
            "string" => strip_tags(htmlspecialchars(htmlentities($var))),
            "integer" => (int) $var,
            "double" => (float) $var,
            "boolean" => (bool) $var,
            default => $var
        };
        return $var;
    }

    /**
     * Sanitizes an array.
     * 
     * @param array $array
     * 
     * @return array
     */
    public function sanitizeArray(array $array): array
    {
        foreach ($array as $key => $value) {
            $array[$key] = $this->sanitizeVariable($value);
        }
        return $array;
    }

}
