<?php

namespace Retamayo\Tablemancer\Traits;

/**
 * Trait SensitiveDataMiddleware
 * 
 * @package Retamayo\Tablemancer\Traits
 */
trait SensitiveDataMiddleware
{

    /**
     * Filters sensitive data
     * 
     * @param array $sensitiveKey
     * @param array $data
     * @param string $arrayType
     * 
     * @return array
     */
    public function filterSensitiveData(array $sensitiveKey, array $data, string $arrayType): array
    {
        $filteredData = [];
        if ($arrayType == "1D") {
            foreach ($data as $key => $value) {
                if (!in_array($key, $sensitiveKey)) {
                    $filteredData[$key] = $value;
                }
            }
        } else if ($arrayType == "2D") {
            foreach ($data as $row) {
                $filteredRow = [];
                foreach ($row as $key => $value) {
                    if (!in_array($key, $sensitiveKey)) {
                        $filteredRow[$key] = $value;
                    }
                }
                $filteredData[] = $filteredRow;
            }
        }
        return $filteredData;
    }
}
