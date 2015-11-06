<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawek@amsterdam-standard.pl>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 */

namespace Vegas\Tests\Stdlib;

use Vegas\Stdlib\StringUtil;

class StringUtilTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldTruncateTextWithGivenEnding()
    {
        $text = 'Lorem ipsum dolor sit amet';
        $this->assertEquals('Lorem ipsum dolor sit...', StringUtil::truncate($text, 21, '...'));
    }

    public function testShouldGenerateRandomString()
    {
        $this->assertRegExp('/[A-Za-z0-9]{10}/i', StringUtil::random(10));
    }
}