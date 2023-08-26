<?php

namespace Retamayo\Tablemancer\Classes;

use Retamayo\Tablemancer\Traits\QueryBuilder;
use Retamayo\Tablemancer\Traits\ExceptionFormatter;
use Retamayo\Tablemancer\Exceptions\ValidationException;

/**
 * Class Validation
 * 
 * @package Retamayo\Tablemancer\Classes
 */
class Validation
{
     /**
     * @trait QueryBuilder
     * @trait ExceptionFormatter
     */
    use QueryBuilder;
    use ExceptionFormatter;

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
     * 
     * @throws ValidationException
     */
    public function checkRecord(string $checkColumn, string|int|float|bool $checkValue): bool
    {
        $query = $this->existsQuery($this->table->name, $checkColumn);
        $statement = $this->connection->prepare($query);
        try {
            if (!$statement->execute([$checkValue])) {
                throw new ValidationException("Failed to execute check query");
            }
            $data = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if (count($data) >= 1) {
                return true;
            } else {
                return false;
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
            "string" => trim(htmlentities(strip_tags(preg_replace('/[^a-zA-Z0-9_]/', '', $var)), ENT_QUOTES, 'UTF-8')),
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
