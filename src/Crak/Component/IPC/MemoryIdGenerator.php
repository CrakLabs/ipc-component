<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC;

/**
 * Class MemoryIdGenerator
 * @package Crak\Component\IPC
 */
class MemoryIdGenerator
{
    const IPC_PREFIX = 'IPC';
    const DEFAULT_TMP_DIR = '/tmp';

    /**
     * @var string
     */
    private $tmpDir;

    /**
     * @param string $tmpDir = null
     */
    public function __construct($tmpDir = self::DEFAULT_TMP_DIR)
    {
        $this->tmpDir = $tmpDir;
    }

    /**
     * @return int
     */
    public function generateId()
    {
        return ftok(tempnam($this->tmpDir, self::IPC_PREFIX), 'm');
    }
} 