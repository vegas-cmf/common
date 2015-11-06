<?php
/**
 * This file is part of Vegas package
 *
 * @author Arkadiusz Ostrycharz <aostrycharz@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Di;

/**
 * Trait InjectionAwareTrait
 *
 * Can be used for classes implementing InjectionAwareInterface
 * Provides methods required by InjectionAwareInterface
 *
 * @package Vegas\Di
 */
trait InjectionAwareTrait
{
    /**
     * Dependency injector
     *
     * @var \Phalcon\DiInterface $dependencyInjector
     */
    protected $di;

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     * @return $this
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->di = $dependencyInjector;

        return $this;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }
}
