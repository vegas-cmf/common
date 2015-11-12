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
 * Class FileUtil
 * @package Vegas\Stdlib
 */
class FileUtil
{
    /**
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    public static function formatSize($bytes, $decimals = 0)
    {
        $bytes = floatval($bytes);
        if ($bytes < 1024) {
            return $bytes . ' B';
        } elseif ($bytes < pow(1024, 2)) {
            return number_format($bytes / 1024, $decimals, '.', '') . ' KiB';
        } elseif ($bytes < pow(1024, 3)) {
            return number_format($bytes / pow(1024, 2), $decimals, '.', '') . ' MiB';
        } elseif ($bytes < pow(1024, 4)) {
            return number_format($bytes / pow(1024, 3), $decimals, '.', '') . ' GiB';
        } elseif ($bytes < pow(1024, 5)) {
            return number_format($bytes / pow(1024, 4), $decimals, '.', '') . ' TiB';
        } elseif ($bytes < pow(1024, 6)) {
            return number_format($bytes / pow(1024, 5), $decimals, '.', '') . ' PiB';
        } else {
            return number_format($bytes / pow(1024, 5), $decimals, '.', '') . ' PiB';
        }
    }

    /**
     * @param $path
     * @return bool
     */
    public static function delete($path)
    {
        $result = false;

        $path = realpath($path);
        if (file_exists($path) && is_writable($path)) {
            $result = unlink($path);
        }

        return $result;
    }


    /**
     * Writes string content to a file
     *
     * @param $filePath
     * @param $content
     * @param bool $compareContents     Determines if new content should be compared with the
     *                                  current file content. When contents are the same, then
     *                                  new content will not be written to the file.
     * @return int                      Number of bytes that were written to the file
     */
    public static function write($filePath, $content, $compareContents = false)
    {
        if ($compareContents) {
            if (self::compareContents($filePath, $content)) {
                return 0;
            }
        }

        return file_put_contents($filePath, $content);
    }

    /**
     * Writes string representation of PHP object into plain file
     *
     * @param $filePath
     * @param $object
     * @param bool $compareContents     Determines if new content should be compared with the
     *                                  current file content. When contents are the same, then
     *                                  new content will not be written to the file.
     * @return int                      Number of bytes that were written to the file
     */
    public static function writeObject($filePath, $object, $compareContents = false)
    {
        $content = '<?php return ' . var_export($object, true) . ';';
        return self::write($filePath, $content, $compareContents);
    }

    /**
     * Compares file contents
     *
     * @param $filePath
     * @param $newContent
     * @return bool
     * @internal
     */
    private static function compareContents($filePath, $newContent)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            return md5_file($filePath) === md5($newContent);
        }

        return false;
    }
}