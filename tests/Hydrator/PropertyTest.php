<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */

namespace Vegas\Tests\Hydrator;

use Vegas\Hydrator\NamingStrategy\CamelCaseToUnderscore;
use Vegas\Hydrator\NamingStrategy\UnderscoreToCamelCase;
use Vegas\Hydrator\Property;

class MockCamelCase {
    public $name;
    public $camelCase;
}

class MockUnderscore {
    public $name;
    public $camel_case;
}

class PropertyTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldHydrateObjectWithData()
    {
        $mockClass = new MockCamelCase();
        $array = [
            'name' => 'Test'
        ];
        (new Property())->hydrate($array, $mockClass);

        $this->assertEquals('Test', $mockClass->name);
    }

    public function testShouldExtractDataFromObject()
    {
        $mockClass = new MockCamelCase();
        $mockClass->name = 'Test';
        $data = (new Property())->extract($mockClass);

        $this->assertArrayHasKey('name', $data);
        $this->assertEquals('Test', $data['name']);
    }

    public function testShouldHydrateObjectWithDataUsingNamingStrategy()
    {
        $mockClass = new MockUnderscore();
        $array = [
            'name' => 'Test',
            'camelCase' => 'Test 2'
        ];

        (new Property(new CamelCaseToUnderscore()))->hydrate($array, $mockClass);
        $this->assertEquals('Test', $mockClass->name);
        $this->assertEquals('Test 2', $mockClass->camel_case);

        $mockClass = new MockCamelCase();
        $array = [
            'name' => 'Test',
            'camel_case' => 'Test 2'
        ];
        (new Property(new UnderscoreToCamelCase()))->hydrate($array, $mockClass);
        $this->assertEquals('Test', $mockClass->name);
        $this->assertEquals('Test 2', $mockClass->camelCase);
    }
}