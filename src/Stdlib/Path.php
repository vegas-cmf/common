<?php
/**
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @company Amsterdam Standard Sp. z o.o.
 */


namespace Vegas\Stdlib;

/**
 * Class Path
 * @package Vegas\Stdlib
 */
class Path
{
    /**
     * @return string
     */
    public static function join() {
        $pieces = array_filter(func_get_args(), function($value) {
            return $value;
        });
        return self::normalize(implode("/", $pieces));
    }

    /**
     * @param $path
     * @return string
     */
    public static function normalize($path) {
        if (!strlen($path)) {
            return ".";
        }
        $isAbsolute    = $path[0];
        $trailingSlash = $path[strlen($path) - 1];
        $up     = 0;
        $pieces = array_values(array_filter(explode("/", $path), function($n) {
            return !!$n;
        }));
        for ($i = count($pieces) - 1; $i >= 0; $i--) {
            $last = $pieces[$i];
            if ($last == ".") {
                array_splice($pieces, $i, 1);
            } else if ($last == "..") {
                array_splice($pieces, $i, 1);
                $up++;
            } else if ($up) {
                array_splice($pieces, $i, 1);
                $up--;
            }
        }
        $path = implode("/", $pieces);

        if ($path && $trailingSlash == "/") {
            $path .= "/";
        }
        return ($isAbsolute == "/" ? "/" : "") . $path;
    }
}