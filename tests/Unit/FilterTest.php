<?php

namespace Retamayo\Tablemancer\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Retamayo\Tablemancer\Classes\Filter;

/**
 * Filter Test
 * 
 * @see Filter
 */
class FilterTest extends TestCase
{
    public function testSearchFilter(): void
    {
        $data = [
            ['bruce'],
            ['ace'],
            ['ace'],
            ['ace'],
            ['ace'],
            ['ace'],
            ['ace'],
        ];
        $filter = new Filter();
        $result = $filter->search("ace", $data);

        $expected = [
            ['ace'],
            ['ace'],
            ['ace'],
            ['ace'],
            ['ace'],
            ['ace'],
        ];

        $this->assertEquals($expected, $result);
        $this->assertIsArray($result);
    }

    public function testPaginateFilter(): void
    {
        $data = [
            ['bruce0'],
            ['bruce1'],
            ['bruce2'],
            ['bruce3'],
            ['bruce4'],
            ['bruce5'],
            ['bruce6'],
            ['bruce7'],
            ['bruce8'],
            ['bruce9'],
        ];

        $filter = new Filter();
        $result = $filter->paginate(2, 5, $data);

        $expected = [
            ['bruce5'],
            ['bruce6'],
            ['bruce7'],
            ['bruce8'],
            ['bruce9'],
        ];

        $this->assertEquals($expected, $result);
        $this->assertIsArray($result);
    }
}
