<?php
/**
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
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
        $flattenArray = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array));
        foreach ($iterator as $item) {
            $flattenArray[] = $item;
        }

        return $flattenArray;
    }
}