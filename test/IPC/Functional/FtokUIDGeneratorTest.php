<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace test\IPC\Functional;

use Crak\Component\IPC\Generator\FtokUIDGenerator;

/**
 * Class FtokUIDGeneratorTest
 * @package test\IPC\Functional
 */
class FtokUIDGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldGenerateAUniqueId()
    {
        $generator = new FtokUIDGenerator();
        $uid = $generator->generateUID();
        $this->assertInternalType('int', $uid);
        $this->assertTrue($uid >= 1000000000, $uid);
    }
}
 