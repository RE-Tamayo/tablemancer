<?php

namespace Retamayo\Tablemancer\Classes;

use Retamayo\Tablemancer\Exceptions\FilterException;
use Retamayo\Tablemancer\Traits\QueryBuilder;
use Retamayo\Tablemancer\Traits\ExceptionFormatter;

/**
 * Class Filter
 * 
 * @package Retamayo\Tablemancer\Classes
 */
class Filter
{
     /**
     * @trait QueryBuilder
     * @trait ExceptionFormatter
     */
    use QueryBuilder;
    use ExceptionFormatter;

    public function __construct() {}

    /**
     * Searches for records.
     * 
     * @param string|int|float|bool $searchQuery
     * @param array $data
     * 
     * @return array
     * 
     * @throws FilterException
     */
    public function search(string|int|float|bool $searchQuery, array $data): array
    {
        try {
            $results = [];
            if (empty($data)) {
                throw new FilterException("No data to search");
            } else {
                foreach ($data as $row) {
                    foreach ($row as $key => $value) {
                        if (preg_match("/$searchQuery/i", $value)) {
                            $results[] = $row;
                        }
                    }
                }
            } 
            return $results;
        } catch (FilterException $e) {
            $this->formatException($e);
            exit();
        }
    }

    /**
     * Paginates records.
     * 
     * @param int $page
     * @param int $perPage
     * @param array $data
     * 
     * @return array
     * 
     * @throws FilterException
     */
    public function paginate(int $page, int $perPage, array $data): array
    {
        try {
            $total = count($data);
            if ($total <= 0) {
                throw new FilterException("No data to paginate");
            } else {
                $totalPages = ceil($total / $perPage);
                $page = max(1, min($page, $totalPages));
                $startIndex = ($page - 1) * $perPage;
                $pagedData = array_slice($data, $startIndex, $perPage);
                return $pagedData;
            }
        } catch (FilterException $e) {
            $this->formatException($e);
            exit();
        }
        
    }

}
