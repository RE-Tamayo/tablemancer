<?php

namespace Retamayo\Tablemancer\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Retamayo\Tablemancer\Traits\SensitiveDataMiddleware;

/**
 * SensitiveDataMiddleware Test
 * 
 * @see SensitiveDataMiddleware
 */
class SensitiveDataMiddlewareTest extends TestCase
{
    use SensitiveDataMiddleware;

    public function testFilterSensitiveData1D()
    {
        $sensitiveKeys = ['password', 'ssn'];
        $data = [
            'username' => 'john_doe',
            'password' => 'secret',
            'email' => 'john@example.com',
        ];

        $filteredData = $this->filterSensitiveData($sensitiveKeys, $data, '1D');

        // Add assertions to test the filteredData
        $this->assertArrayHasKey('username', $filteredData);
        $this->assertArrayNotHasKey('password', $filteredData);
        $this->assertArrayHasKey('email', $filteredData);
    }

    public function testFilterSensitiveData2D()
    {
        $sensitiveKeys = ['password', 'ssn'];
        $data = [
            [
                'username' => 'john_doe',
                'password' => 'secret',
            ],
            [
                'username' => 'jane_doe',
                'password' => 'topsecret',
            ],
        ];

        $filteredData = $this->filterSensitiveData($sensitiveKeys, $data, '2D');

        // Add assertions to test the filteredData
        $this->assertCount(2, $filteredData); // Make sure there are 2 rows in the result.
        $this->assertArrayHasKey('username', $filteredData[0]);
        $this->assertArrayNotHasKey('password', $filteredData[0]);
        $this->assertArrayHasKey('username', $filteredData[1]);
        $this->assertArrayNotHasKey('password', $filteredData[1]);
    }
}