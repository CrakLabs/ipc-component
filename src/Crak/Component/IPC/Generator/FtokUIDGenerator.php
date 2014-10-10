<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC\Generator;

use Crak\Component\IPC\FtokUUID;
use Crak\Component\IPC\UUID;

/**
 * Class FtokUIDGenerator
 * @package Crak\Component\IPC
 */
class FtokUIDGenerator implements UIDGenerator
{
    const IPC_TMP_FILE_PREFIX = 'IPC';

    const DEFAULT_TMP_DIR = '/tmp';
    const DEFAULT_PROJECT_ID = 'a';

    /**
     * @var string
     */
    private $tmpDir;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @param string $tmpDir = null [optional] default=MemoryIdGenerator::DEFAULT_TMP_DIR
     * @param string $projectId = null [optional] default=MemoryIdGenerator::DEFAULT_PROJECT_ID
     */
    public function __construct($tmpDir = null, $projectId = null)
    {
        $this->tmpDir = $tmpDir;
        $this->projectId = $projectId;

        $this->setDefaults();

        $this->projectId = substr($this->projectId, 0, 1);
    }

    private function setDefaults()
    {
        if (is_null($this->tmpDir)) {
            $this->tmpDir = self::DEFAULT_TMP_DIR;
        }
        if (is_null($this->projectId)) {
            $this->projectId = self::DEFAULT_PROJECT_ID;
        }
    }

    /**
     * Generates a System V IPC key based on an unique file name.
     *
     * @return FtokUUID
     */
    public function generateUID()
    {
        $filename = tempnam($this->tmpDir, self::IPC_TMP_FILE_PREFIX);

        return new FtokUUID(ftok($filename, $this->projectId), $filename);
    }
} 