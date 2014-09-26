<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC\Generator;

/**
 * Interface UIDGenerator
 * @package Crak\Component\IPC
 */
interface UIDGenerator
{
    /**
     * @return int
     */
    public function generateUID();
}