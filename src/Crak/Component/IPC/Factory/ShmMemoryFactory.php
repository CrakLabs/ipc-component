<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC\Factory;

use Crak\Component\IPC\Generator\UIDGenerator;
use Crak\Component\IPC\Memory;
use Crak\Component\IPC\ShmMemory;

/**
 * Class ShmMemoryFactory
 * @package Crak\Component\IPC\Factory
 */
class ShmMemoryFactory implements MemoryFactory
{
    /**
     * @var UIDGenerator
     */
    private $uidGenerator;

    /**
     * @param UIDGenerator $uidGenerator
     */
    public function __construct(UIDGenerator $uidGenerator)
    {
        $this->uidGenerator = $uidGenerator;
    }

    /**
     * @param int $id = null
     *
     * @return Memory
     */
    public function create($id = null)
    {
        if (is_null($id)) {
            $id = $this->uidGenerator->generateUID();
        }

        return new ShmMemory($id);
    }
}