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
 * Class CamelCase
 * Converts underscore notation to camel case
 *
 * @package Vegas\Hydrator\NamingStrategy
 */
class UnderscoreToCamelCase implements NamingStrategyInterface
{

    /**
     * @param $name
     * @return mixed
     */
    public function convert($name)
    {
        $pregQuotedSeparator = preg_quote('_', '#');
        $patterns = [
            '#(' . $pregQuotedSeparator.')([\S]{1})#',
            '#(^[\S]{1})#',
        ];
        $replacements = [
            function ($matches) {
                return strtoupper($matches[2]);
            },
            function ($matches) {
                return strtoupper($matches[1]);
            },
        ];
        $filtered = $name;
        foreach ($patterns as $index => $pattern) {
            $filtered = preg_replace_callback($pattern, $replacements[$index], $filtered);
        }

        return lcfirst($filtered);
    }
}