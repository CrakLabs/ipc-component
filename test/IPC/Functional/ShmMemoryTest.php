<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Test\IPC\Functional;

use Crak\Component\IPC\Factory\ShmMemoryFactory;
use Crak\Component\IPC\Generator\FtokUIDGenerator;
use Crak\Component\IPC\Lock\SmLock;
use Crak\Component\IPC\ShmMemory;

/**
 * Class ShmMemoryTest
 * @package Test\IPC
 */
class ShmMemoryTest extends \PHPUnit_Framework_TestCase
{
    const TMP_DIR = './tmp';
    const PROJECT_ID = 't';

    /**
     * @var ShmMemory
     */
    private static $memory;

    public function testShouldHaveAnUID()
    {
        $memory = $this->getMemory();

        $uid = $memory->getId();
        $this->assertInternalType('int', $uid);
        $this->assertTrue($uid >= 1000000000, $uid);
    }

    public function testShouldGetAndSet()
    {
        $memory = $this->getMemory();

        $this->assertFalse($memory->get('var1'));
        $memory->set('var1', 'yolo1');
        $memory->set('var1', 'yolo2');
        $this->assertSame('yolo2', $memory->get('var1'));
        $memory->del('var1');
        $this->assertFalse($memory->get('var1'));
    }

    public function testShouldBeCleared()
    {
        $memory = $this->getMemory();

        $memory->set('var1', 'yolo1');
        $this->assertSame('yolo1', $memory->get('var1'));

        $memory->set('var2', 'yolo2');
        $this->assertSame('yolo2', $memory->get('var2'));

        $memory->clear();

        $this->assertFalse($memory->get('var1'));
        $this->assertFalse($memory->get('var2'));
    }

    public function testShouldBeDestroyed()
    {
        $memory = $this->getMemory();

        $this->assertSame(1, $memory->getNbProcess());
        $memory->destroy();
        $this->assertSame(0, $memory->getNbProcess());

        $memory->__destruct();

        $this->assertSame(0, $memory->getNbProcess());
    }

    /**
     * @return ShmMemory
     */
    public function getMemory()
    {
        if (is_null(self::$memory)) {
            $uid = (new FtokUIDGenerator(__DIR__ . '/tmp', self::PROJECT_ID))
                ->generateUID()
                ->getValue();
            self::$memory = new ShmMemory($uid, new SmLock($uid));
        }

        self::$memory->clear();

        return self::$memory;
    }
} 
