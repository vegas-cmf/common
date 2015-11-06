<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */

namespace Vegas\Tests\Stdlib;

use Vegas\Stdlib\ArrayUtil;
use Vegas\Stdlib\StringUtil;

class ArrayUtilTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldFlattenMultiDimArray()
    {
        $array = [
            1, 2, 3, [4, 5, 6, [7, 8, 9]]
        ];

        $this->assertSame(range(1, 9), ArrayUtil::flatten($array));
    }
}