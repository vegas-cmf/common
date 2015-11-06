<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Hydrator\NamingStrategy;

/**
 * Interface NamingStrategyInterface
 * @package Vegas\Hydrator\NamingStrategy
 */
interface NamingStrategyInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function convert($name);
}