<?php

namespace Retamayo\Tablemancer\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Retamayo\Tablemancer\Traits\QueryBuilder;

/**
 * Query Builder Test
 * 
 * @see QueryBuilder
 */
class QueryBuilderTest extends TestCase
{
    use QueryBuilder;
    
    public function testInsertQuery(): void {
        $table = "test";
        $columns = ["name", "age"];
        $query =$this->insertQuery($table, $columns);

        $expectedQuery = "INSERT INTO test (name, age) VALUES (?, ?);";
        $this->assertEquals($expectedQuery, $query);
        $this->assertIsString($query);
    }

    public function testUpdateQuery(): void {
        $table = "test";
        $columns = ["name", "age"];
        $query =$this->updateQuery($table, $columns, "id");

        $expectedQuery = "UPDATE `test` SET `name` = ?, `age` = ? WHERE `id` = ?;";
        $this->assertEquals($expectedQuery, $query);
        $this->assertIsString($query);
    }

    public function testDeleteQuery(): void {
        $table = "test";
        $query =$this->deleteQuery($table, "id");

        $expectedQuery = "DELETE FROM `test` WHERE `id` = ?;";
        $this->assertEquals($expectedQuery, $query);
        $this->assertIsString($query);
    }

    public function testListQuery(): void {
        $table = "test";
        $columns = ["name", "age"];
        $query =$this->listQuery($table, $columns);

        $expectedQuery = "SELECT `name`, `age` FROM `test`;";
        $this->assertEquals($expectedQuery, $query);
        $this->assertIsString($query);
    }

    public function testListSingleQuery(): void {
        $table = "test";
        $columns = ["name", "age"];
        $where = "id";
        $query =$this->listSingleQuery($table, $columns, $where);

        $expectedQuery = "SELECT `name`, `age` FROM `test` WHERE `id` = ?;";
        $this->assertEquals($expectedQuery, $query);
    }

    public function testExistsQuery(): void {
        $table = "test";
        $where = "id";
        $query =$this->existsQuery($table, $where);

        $expectedQuery = "SELECT * FROM `test` WHERE `id` = ?;";
        $this->assertEquals($expectedQuery, $query);
        $this->assertIsString($query);
    }
}