<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC\Generator;
use Crak\Component\IPC\UUID;

/**
 * Interface UIDGenerator
 * @package Crak\Component\IPC
 */
interface UIDGenerator
{
    /**
     * @return UUID
     */
    public function generateUID();
}