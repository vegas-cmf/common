<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */

namespace Vegas\Tests\Stdlib;

use Vegas\Stdlib\Path;
class PathTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldCreatePathFromArgs()
    {
        $this->assertEquals(
            '/tmp/test/value/foo.bar',
            Path::join('/tmp/test', 'value', 'foo.bar')
        );
    }

    public function testChecksNormalizingReturn()
    {
        $this->assertEquals('.', Path::normalize(''));

        $this->assertEquals('tmp/test', Path::normalize('./tmp/test'));

        $this->assertEquals('/tmp/test', Path::normalize('/tmp/../tmp/test'));

        $this->assertEquals('test/', Path::normalize('./test/'));
    }
}

