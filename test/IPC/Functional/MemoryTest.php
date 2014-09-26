<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Test\IPC\Functional;

use Crak\Component\IPC\Memory;

/**
 * Class MemoryTest
 * @package Test\IPC
 */
class MemoryTest extends \PHPUnit_Framework_TestCase
{
    const FIX_ID = 1667755544;

    /**
     * @var int
     */
//    private $id;

    /**
     * @var Memory
     */
    private $memory;

    public function setUp()
    {
//        $idGenerator = new MemoryIdGenerator(__DIR__ . '/tmp');
//        $this->id = $idGenerator->generateId();
//        fwrite(STDERR, "MemoryId generated: {$this->id}\n");

        $this->memory = new Memory(self::FIX_ID);
        $this->memory->clear();
    }

    public function testShouldGetAndSet()
    {
        $this->assertFalse($this->memory->get('var1'));
        $this->memory->set('var1', 'yolo');
        $this->assertSame('yolo', $this->memory->get('var1'));
        $this->memory->del('var1');
        $this->assertfalse($this->memory->get('var1'));
    }

    public function testShouldSetAnObject()
    {
        $obj = new \stdClass();
        $this->assertFalse($this->memory->get('obj'));
        $this->memory->set('obj', $obj);
        $this->assertSame(json_encode($obj), json_encode($this->memory->get('obj')));
    }
} 