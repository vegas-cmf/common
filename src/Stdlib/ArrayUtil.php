<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */


namespace Vegas\Stdlib;

/**
 * Class ArrayUtil
 * @package Vegas\Stdlib
 */
class ArrayUtil
{
    /**
     * @param $array
     * @return array
     */
    public static function flatten($array)
    {
        $flattenedArray = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array));
        foreach ($iterator as $item) {
            $flattenedArray[] = $item;
        }

        return $flattenedArray;
    }
}