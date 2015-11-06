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
 * Class StringUtil
 * @package Vegas\Stdlib
 */
class StringUtil
{
    /**
     * @param $text
     * @param int $length
     * @param string $endString
     * @return string
     */
    public static function truncate($text, $length = 100, $endString = '...')
    {
        $substring = strip_tags(preg_replace('/<br.?\/?>/', ' ',$text));
        $textLength = mb_strlen($substring);

        if($textLength > $length) {
            $lastWordPosition = mb_strpos($substring, ' ', $length);

            if($lastWordPosition) {
                $substring = mb_substr($substring, 0, $lastWordPosition);
            } else {
                $substring = mb_substr($substring, 0, $length);
            }

            $substring.= $endString;
        }

        return $substring;
    }

    /**
     * Generates random string with given length
     *
     * @param $length
     * @return string
     */
    public static function random($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}