<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC\Lock;

/**
 * Interface Lock
 * @package Crak\Component\IPC
 */
interface Lock
{
    /**
     * @return bool
     */
    public function lock();

    /**
     * @return bool
     */
    public function unlock();
} 