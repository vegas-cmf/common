<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */

namespace Vegas\Tests\Hydrator;

use Vegas\Hydrator\Method;
use Vegas\Hydrator\NamingStrategy\CamelCaseToUnderscore;
use Vegas\Hydrator\NamingStrategy\UnderscoreToCamelCase;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    protected function getMockedClassCamelCase()
    {
        $classProps = [];
        $mockClass = $this->getMockBuilder('\stdClass')
            ->setMockClassName('TestCamelCase')
            ->setMethods([
                'getName', 'setName', 'setCamelCase', 'getCamelCase'
            ])
            ->getMock();

        $mockClass->expects($this->any())
            ->method('setName')
            ->willReturnCallback(function($name) use (&$classProps) {
                $classProps['name'] = $name;
            });

        $mockClass->expects($this->any())
            ->method('getName')
            ->willReturnCallback(function() use (&$classProps) {
                return isset($classProps['name']) ? $classProps['name'] : null;
            });

        $mockClass->expects($this->any())
            ->method('setCamelCase')
            ->willReturnCallback(function($camelCase) use (&$classProps) {
                $classProps['camelCase'] = $camelCase;
            });

        $mockClass->expects($this->any())
            ->method('getCamelCase')
            ->willReturnCallback(function() use (&$classProps) {
                return isset($classProps['camelCase']) ? $classProps['camelCase'] : null;
            });

        return $mockClass;
    }
    protected function getMockedClassUnderscore()
    {
        $classProps = [];
        $mockClass = $this->getMockBuilder('\stdClass')
            ->setMockClassName('TestUnderscore')
            ->setMethods([
                'set_camel_case', 'get_camel_case', 'get_name', 'set_name'
            ])
            ->getMock();

        $mockClass->expects($this->any())
            ->method('set_name')
            ->willReturnCallback(function($name) use (&$classProps) {
                $classProps['name'] = $name;
            });

        $mockClass->expects($this->any())
            ->method('get_name')
            ->willReturnCallback(function() use (&$classProps) {
                return isset($classProps['name']) ? $classProps['name'] : null;
            });

        $mockClass->expects($this->any())
            ->method('set_camel_case')
            ->willReturnCallback(function($camelCase) use (&$classProps) {
                $classProps['camelCase'] = $camelCase;
            });

        $mockClass->expects($this->any())
            ->method('get_camel_case')
            ->willReturnCallback(function() use (&$classProps) {
                return isset($classProps['camelCase']) ? $classProps['camelCase'] : null;
            });

        return $mockClass;
    }

    public function testShouldHydrateObjectWithData()
    {
        $mockClass = $this->getMockedClassCamelCase();
        $array = [
            'name' => 'Test'
        ];
        (new Method())->hydrate($array, $mockClass);

        $this->assertEquals('Test', $mockClass->getName());
    }

    public function testShouldExtractDataFromObject()
    {
        $mockClass = $this->getMockedClassCamelCase();
        $mockClass->setName('Test');
        $data = (new Method())->extract($mockClass);

        $this->assertArrayHasKey('name', $data);
        $this->assertEquals('Test', $data['name']);
    }

    public function testShouldHydrateUnderscoreObjectWithCamelCaseData()
    {
        $mockClass = $this->getMockedClassUnderscore();
        $array = [
            'name' => 'Test',
            'camelCase' => 'Test 2'
        ];

        (new Method(new CamelCaseToUnderscore()))->hydrate($array, $mockClass);
        $this->assertEquals('Test', $mockClass->get_name());
        $this->assertEquals('Test 2', $mockClass->get_camel_case());

        $this->assertArraySubset($array, (new Method(new UnderscoreToCamelCase()))->extract($mockClass));
    }

    public function testShouldHydrateCamelCaseObjectWithUnderscoreData()
    {
        $mockClass = $this->getMockedClassCamelCase();
        $array = [
            'name' => 'Test',
            'camel_case' => 'Test 2'
        ];
        (new Method(new UnderscoreToCamelCase()))->hydrate($array, $mockClass);
        $this->assertEquals('Test', $mockClass->getName());
        $this->assertEquals('Test 2', $mockClass->getCamelCase());

        $this->assertArraySubset($array, (new Method(new CamelCaseToUnderscore()))->extract($mockClass));
    }
}