<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Test\IPC\Functional;

use Crak\Component\IPC\Factory\ShmMemoryFactory;
use Crak\Component\IPC\Generator\FtokUIDGenerator;
use Crak\Component\IPC\Memory;

/**
 * Class ShmMemoryTest
 * @package Test\IPC
 */
class ShmMemoryTest extends \PHPUnit_Framework_TestCase
{
    const TMP_DIR = './tmp';
    const PROJECT_ID = 't';

    /**
     * @var Memory
     */
    private static $memory;

    public function setUp()
    {
        if (is_null(self::$memory)) {
            $uidGenerator = new FtokUIDGenerator(self::TMP_DIR, self::PROJECT_ID);
            $memFactory = new ShmMemoryFactory($uidGenerator);

            self::$memory = $memFactory->create();
        }

        self::$memory->clear();
    }

    public function testShouldGetAndSet()
    {
        $this->assertFalse(self::$memory->get('var1'));
        self::$memory->set('var1', 'yolo');
        $this->assertSame('yolo', self::$memory->get('var1'));
        self::$memory->del('var1');
        $this->assertfalse(self::$memory->get('var1'));
    }

    public function testShouldSetAnObject()
    {
        $obj = new \stdClass();
        $this->assertFalse(self::$memory->get('obj'));
        self::$memory->set('obj', $obj);
        $this->assertSame(json_encode($obj), json_encode(self::$memory->get('obj')));
    }
} 