<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC\Factory;

use Crak\Component\IPC\Memory;

/**
 * Interface MemoryFactory
 * @package Crak\Component\IPC\Factory
 */
interface MemoryFactory
{
    /**
     * @param int $id
     *
     * @return Memory
     */
    public function create($id);
} 