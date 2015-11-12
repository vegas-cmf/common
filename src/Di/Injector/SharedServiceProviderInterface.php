<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Di\Injector;
use Phalcon\DI\InjectionAwareInterface;

/**
 * Interface SharedServiceProviderInterface
 * @package Vegas\Di\Injector
 */
interface SharedServiceProviderInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function getProvider(\Phalcon\DiInterface $di);
}