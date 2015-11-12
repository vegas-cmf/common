<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Di;

use Phalcon\Di\InjectionAwareInterface;
use Vegas\Di\Injector\Exception\InvalidServiceException;
use Vegas\Di\Injector\InjectableInterface;

/**
 * Class Injector
 * @package Vegas\Di
 */
class Injector implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * Injector constructor.
     * @param \Phalcon\DiInterface $di
     */
    public function __construct(\Phalcon\DiInterface $di)
    {
        $this->setDI($di);
    }

    /**
     * @param array $services
     * @throws InvalidServiceException
     */
    public function inject(array $services)
    {
        foreach ($services as $service) {
            $serviceInstance = $this->obtainService($service);
            $serviceInstance->inject($this->getDI());
        }
    }

    /**
     * @param $serviceClassName
     * @return InjectableInterface
     * @throws InvalidServiceException
     */
    protected function obtainService($serviceClassName)
    {
        $reflection = new \ReflectionClass($serviceClassName);
        $instance = $reflection->newInstance();
        if (!$instance instanceof InjectableInterface) {
            throw new InvalidServiceException();
        }

        return $instance;
    }
}