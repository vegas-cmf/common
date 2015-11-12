<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Tests\Di;

use Vegas\Di\Injector;

class InjectorTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldRegisterServicesDefinedInArray()
    {
        $di = new \Phalcon\Di\FactoryDefault();

        $fooClassStr = 'class Foo implements \Vegas\Di\Injector\SharedServiceProviderInterface {
            public function getName() {
                return "foo";
            }
            public function getProvider(\Phalcon\DiInterface $di) {
                return function() {
                    $o = new \stdClass;
                    $o->foo = "bar";
                    return $o;
                };
            }
        }';
        eval($fooClassStr);

        $barClassStr = 'class Bar implements \Vegas\Di\Injector\SharedServiceProviderInterface {
            public function getName() {
                return "bar";
            }
            public function getProvider(\Phalcon\DiInterface $di) {
                return function() {
                    $o = new \stdClass;
                    $o->bar = "foo";
                    return $o;
                };
            }
        }';
        eval($barClassStr);

        $injector = new Injector($di);
        $injector->inject(['Foo', 'Bar']);

        $this->assertTrue($di->has('foo'));
        $this->assertNotNull($di->get('foo'));
        $this->assertNotNull($di->get('bar'));
        $this->assertEquals("foo", $di->get('bar')->bar);
        $this->assertEquals("bar", $di->get('foo')->foo);
    }

    public function testShouldNotInjectInvalidClass()
    {
        $di = new \Phalcon\Di\FactoryDefault();

        $fooClassStr = 'class Invalid {
            public function register(\Phalcon\DiInterface $di) {
                $o = new \stdClass;
                $o->foo = "bar";
                $di->set("foo", $o);
            }
        }';
        eval($fooClassStr);

        $exception = null;
        try {
            $injector = new Injector($di);
            $injector->inject(['Invalid']);
        } catch (\Exception $e) {
            $exception = $e;
        }
        $this->assertInstanceOf('\Vegas\Di\Injector\Exception\InvalidServiceException', $exception);
    }
}