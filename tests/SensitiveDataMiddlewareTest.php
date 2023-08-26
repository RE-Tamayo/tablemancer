<?php

namespace Retamayo\Absl\Tests;

use PHPUnit\Framework\TestCase;
use Retamayo\Absl\Traits\SensitiveDataMiddleware;
use Retamayo\Absl\Classes\Table;

class SensitiveDataMiddlewareTest extends TestCase
{
    use SensitiveDataMiddleware;

    public function testIsBeingFiltered(): void
    {
        $data = [
            'username' => 'test_username',
            'email' => 'test_email',
            'password' => 'test_password',
        ];

        $result = $this->filterSensitiveData(
            sensitiveKey: ['password'],
            data: $data
        );

        $expected = [
            'username' => 'test_username',
            'email' => 'test_email'
        ];

        $this->assertSame($expected, $result);

    }
}