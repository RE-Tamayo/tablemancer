<?php

namespace Retamayo\Absl\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Retamayo\Absl\Classes\Validation;

/**
 * Validation Test
 * 
 * @see Validation
 */
class ValidationTest extends TestCase
{
    public function testSanitizeVariableString(): void
    {
        $validation = new Validation(null, null);
        $var = $validation->sanitizeVariable("hello! <world>");
        $expected = "helloworld";
        $this->assertEquals($expected, $var);
        $this->assertIsString($var);
    }

    public function testSanitizeVariableInt(): void
    {
        $validation = new Validation(null, null);
        $var = $validation->sanitizeVariable(123);
        $this->assertIsInt($var);
    }

    public function testSanitizeVariableFloat(): void
    {
        $validation = new Validation(null, null);
        $var = $validation->sanitizeVariable(123.23);
        $this->assertIsFloat($var);
    }

    public function testSanitizeVariableBool(): void
    {
        $validation = new Validation(null, null);
        $var = $validation->sanitizeVariable(true);
        $this->assertIsBool($var);
    }

    public function testSanitizeArray(): void
    {
        $validation = new Validation(null, null);
        $var = $validation->sanitizeArray(["hello", "world"]);
        $expected = ["hello", "world"];
        $this->assertEquals($expected, $var);
        $this->assertIsArray($var);
    }
    
}