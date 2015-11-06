<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 * @homepage http://cmf.vegas
 */

namespace Vegas\Hydrator;

/**
 * Interface HydrationInterface
 * @package Vegas\Hydrator
 */
interface HydrationInterface
{
    /**
     * @param array $data
     * @param $object
     */
    public function hydrate(array $data, $object);
}