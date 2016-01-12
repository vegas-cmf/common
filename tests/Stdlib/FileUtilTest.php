<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */

namespace Vegas\Tests\Stdlib;

use Vegas\Stdlib\FileUtil;

class FileUtilTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldWriteContentToFile()
    {
        $content = sha1(time());
        $path = TESTS_ROOT_DIR . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'test.tmp';
        $this->assertGreaterThan(0, FileUtil::write($path, $content, false));
        $this->assertEquals($content, file_get_contents($path));

        unlink($path);
    }

    public function testShouldNotWriteContentToIdenticalFile()
    {
        $content = sha1(time());
        $path = TESTS_ROOT_DIR . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'test.tmp';
        $this->assertGreaterThan(0, FileUtil::write($path, $content, false));
        $this->assertSame(0, FileUtil::write($path, $content, true));

        unlink($path);
    }

    public function testShouldUpdateFileContentWithDifferentContent()
    {
        $content = sha1(microtime());
        $path = TESTS_ROOT_DIR . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'test.tmp';
        $this->assertGreaterThan(0, FileUtil::write($path, $content, false));
        $content = sha1(microtime());
        $this->assertGreaterThan(0, FileUtil::write($path, $content, true));

        unlink($path);
    }

    public function testShouldWriteContentToFileWhenNotExists()
    {
        $content = sha1(microtime());
        $path = TESTS_ROOT_DIR . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'test.tmp';
        $this->assertGreaterThan(0, FileUtil::write($path, $content, true));

        unlink($path);
    }

    public function testShouldWriteObjectToFile()
    {
        $content = new \stdClass();
        $path = TESTS_ROOT_DIR . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'test.tmp';
        $this->assertGreaterThan(0, FileUtil::writeObject($path, $content, true));

        unlink($path);
    }

    public function testShouldFormatFileSizeToReadable()
    {
        $sizes = [
            10*100 => 'B',
            10*10000 => 'KiB',
            10*1000000 => 'MiB',
            10*1000000000 => 'GiB',
            10*1000000000000 => 'TiB',
            10*1000000000000000 => 'PiB',
            (pow(1024, 6)+1) => 'PiB'
        ];
        foreach ($sizes as $size => $str) {
            $this->assertContains($str, FileUtil::formatSize($size));
        }
    }

    public function testShouldDeleteFile()
    {
        $path = TESTS_ROOT_DIR . '/fixtures/foo';
        touch($path);
        $this->assertGreaterThan(0, FileUtil::delete($path));
        $path .= '_';
        $this->assertEquals(0, FileUtil::delete($path));
    }
}
 