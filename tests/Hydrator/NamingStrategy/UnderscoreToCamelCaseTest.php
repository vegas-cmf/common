<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */

namespace Vegas\Tests\Hydrator\NamingStrategy;

use Vegas\Hydrator\NamingStrategy\UnderscoreToCamelCase;

class UnderscoreToCamelCaseTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldConvertUnderscoreToCamelCase()
    {
        $naming = new UnderscoreToCamelCase();
        $this->assertEquals('camelCase', $naming->convert('camel_case'));
        $this->assertEquals('camelCase', $naming->convert('_camel_case'));
        $this->assertEquals('setCamelCase', $naming->convert('set_camel_case'));
        $this->assertEquals('set', $naming->convert('set'));
    }
}