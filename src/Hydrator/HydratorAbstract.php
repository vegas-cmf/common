<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Hydrator;

use Vegas\Hydrator\NamingStrategy\NamingStrategyInterface;

/**
 * Class HydratorAbstract
 * @package Vegas\Hydrator
 */
abstract class HydratorAbstract implements HydratorInterface
{
    /**
     * HydratorAbstract constructor.
     * @param NamingStrategyInterface $namingStrategy
     */
    public function __construct(NamingStrategyInterface $namingStrategy = null)
    {
        if ($namingStrategy instanceof NamingStrategyInterface) {
            $this->setNamingStrategy($namingStrategy);
        }
    }

    /**
     * @var
     */
    protected $namingStrategy;

    /**
     * @param NamingStrategyInterface $namingStrategy
     */
    public function setNamingStrategy(NamingStrategyInterface $namingStrategy)
    {
        $this->namingStrategy = $namingStrategy;
    }

    /**
     * @return bool
     */
    public function hasNamingStrategy()
    {
        return $this->namingStrategy instanceof NamingStrategyInterface;
    }
}