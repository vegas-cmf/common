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
 * Interface ExtractionInterface
 * @package Vegas\Hydrator
 */
interface ExtractionInterface
{
    /**
     * @param $object
     * @return mixed
     */
    public function extract($object);
}