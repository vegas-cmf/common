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
 * Class Underscore
 * Converts camel case notation to underscore
 * @package Vegas\Hydrator\NamingStrategy
 */
class CamelCaseToUnderscore implements NamingStrategyInterface
{

    /**
     * @param $name
     * @return mixed
     */
    public function convert($name)
    {
        $name = str_replace('\\', '/', $name);
        $name = preg_replace_callback(
            '/(?:([[:alpha:]\d])|^)(' . trim('/(?=a)b/', '/') . ')(?=\b|[^[:lower:]])/u',
            function($matches) {
                list(, $m1, $m2) = $matches;
                return $m1 . ($m1 ? '_' : '') . mb_strtolower($m2);
            },
            $name
        );
        $name = preg_replace('/([[:upper:]\d]+)([[:upper:]][[:lower:]])/u', '\1_\2', $name);
        $name = preg_replace('/([[:lower:]\d])([[:upper:]])/u','\1_\2', $name);
        $name = strtr($name, "-", "_");
        $name = mb_strtolower($name);
        return $name;
    }
}