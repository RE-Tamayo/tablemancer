<?php

namespace Retamayo\Absl\Traits;

/**
 * Trait Query
 * 
 * @package Retamayo\Absl\Traits
 */
trait Query
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
        return $query = "SELECT `" . rtrim(implode("`, `", $columns), ",") . "` FROM `$table`;";
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
        return $query = "SELECT `" . rtrim(implode("`, `", $columns), ",") . "` FROM `$table` WHERE `$where` = ?;";
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
}
