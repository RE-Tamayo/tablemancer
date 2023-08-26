<?php

namespace Retamayo\Absl\Traits;

/**
 * Trait Query
 * 
 * @package Retamayo\Absl\Traits
 */
trait QueryBuilder
{
    /**
     * Creates an insert query
     * 
     * @param string $table
     * @param array $columns
     * 
     * @return string
     */
    public function insertQuery(string $table, array $columns): string
    {   
        return $query = "INSERT INTO $table (" . rtrim(implode(", ", $columns), ",") . ") VALUES (" . rtrim(str_repeat("?, ", count($columns)), ", ") . ");";
    }

    /**
     * Creates a select query
     * 
     * @param string $table
     * @param array $columns
     * 
     * @return string
     */
    public function listQuery(string $table, array $columns): string {
        if (count($columns) < 1) {
            $query = "SELECT * FROM `$table`;";
        } else {
            $query = "SELECT `" . rtrim(implode("`, `", $columns), ",") . "` FROM `$table`;";
        }
        return $query;
    }

    /**
     * Creates a select where query
     * 
     * @param string $table
     * @param array $columns
     * @param string $where
     * 
     * @return string
     */
    public function listSingleQuery(string $table, array $columns, string $where): string {
        if (count($columns) < 1) {
            $query = "SELECT * FROM `$table` WHERE `$where` = ?;";
        } else {
            $query = "SELECT `" . rtrim(implode("`, `", $columns), ",") . "` FROM `$table` WHERE `$where` = ?;";
        }
        return $query;
    }

    /**
     * Creates an update query
     * 
     * @param string $table
     * @param array $columns
     * @param string $where
     * 
     * @return string
     */
    public function updateQuery(string $table, array $columns, string $where): string
    {
        return $query = "UPDATE `$table` SET `" . implode("` = ?, `", $columns)."` = ?" . " WHERE `$where` = ?;";
    }

    /**
     * Creates a delete query
     * 
     * @param string $table
     * @param string $where
     * 
     * @return string
     */
    public function deleteQuery(string $table, string $where): string
    {
        return $query = "DELETE FROM `$table` WHERE `$where` = ?;";
    }

    /**
     * Creates a query that checks if a record exists.
     * 
     * @param string $table
     * @param string $where
     * 
     * @return string
     */
    public function existsQuery(string $table, string $where): string
    {
        return $query = "SELECT * FROM `$table` WHERE `$where` = ?;";
    }
}
