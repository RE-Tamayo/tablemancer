<?php

namespace Retamayo\Absl\Traits;

trait Query
{
    public function insertQuery(string $table, array $columns): string
    {   
        return $query = "INSERT INTO $table (" . rtrim(implode(", ", $columns), ",") . ") VALUES (" . rtrim(str_repeat("?, ", count($columns)), ", ") . ");";
    }

    public function listQuery(string $table, array $columns): string {
        return $query = "SELECT `" . rtrim(implode("`, `", $columns), ",") . "` FROM `$table`;";
    }

    public function listSingleQuery(string $table, array $columns, string $where): string {
        return $query = "SELECT `" . rtrim(implode("`, `", $columns), ",") . "` FROM `$table` WHERE `$where` = ?;";
    }

    public function updateQuery(string $table, array $columns, string $where): string
    {
        return $query = "UPDATE `$table` SET `" . implode("` = ?, `", $columns)."` = ?" . " WHERE `$where` = ?;";
    }

    public function deleteQuery(string $table, string $where): string
    {
        return $query = "DELETE FROM `$table` WHERE `$where` = ?;";
    }

    public function extractKeysAndValues(array $data): array
    {
        $keys = array_keys($data);
        $values = array_values($data);
        return ["keys" => $keys, "values" => $values];
    }
}
