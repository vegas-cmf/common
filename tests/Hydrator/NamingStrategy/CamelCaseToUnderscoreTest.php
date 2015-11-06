<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */

namespace Vegas\Tests\Hydrator\NamingStrategy;

use Vegas\Hydrator\NamingStrategy\CamelCaseToUnderscore;

class CamelCaseToUnderscoreTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldConvertCamelCaseToUnderscore()
    {
        $naming = new CamelCaseToUnderscore();
        $this->assertEquals('under_score', $naming->convert('underScore'));
    }
}