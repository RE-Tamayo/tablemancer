<?php

namespace Retamayo\Absl\Traits;

/**
 * Trait SensitiveDataMiddleware
 * 
 * @package Retamayo\Absl\Traits
 */
trait SensitiveDataMiddleware
{

    /**
     * Filters sensitive data
     * 
     * @param array $sensitiveKey
     * 
     * @return array
     */
    public function filterSensitiveData(array $sensitiveKey, array $data): array
    {
        $filteredData = [];
        foreach ($data as $row) {
            foreach ($row as $key => $value) {
                if (!in_array($key, $sensitiveKey)) {
                    $filteredData[$key] = $value;
                }
            }
        }
        return $filteredData;
    }
}
