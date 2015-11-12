<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Di\Injector;

/**
 * Interface InjectableInterface
 * @package Vegas\Di\Injector
 */
interface InjectableInterface
{
    /**
     * @param \Phalcon\DiInterface $di
     * @return mixed
     */
    public function inject(\Phalcon\DiInterface $di);
}