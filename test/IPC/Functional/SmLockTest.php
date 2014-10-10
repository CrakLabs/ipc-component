<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace test\IPC\Functional;

use Crak\Component\IPC\Lock\SmLock;

/**
 * Class SmLockTest
 * @package test\IPC\Functional
 */
class SmLockTest extends \PHPUnit_Framework_TestCase
{
    const ID = 123456789;

    /**
     * @var SmLock
     */
    private $lock;

    public function setUp()
    {
        $this->lock = new SmLock(self::ID);
    }

    public function testShouldLockUnlock()
    {
        $this->assertTrue($this->lock->lock());
        $this->assertTrue($this->lock->unlock());
    }
} 