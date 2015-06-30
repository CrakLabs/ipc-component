<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC\Lock;

/**
 * Class SmLock
 * @package Crak\Component\IPC\Lock
 */
class SmLock implements LockInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var resource
     */
    private $lock;

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function __destruct()
    {
        if (!is_null($this->lock)) {
            $this->unlock();
        }
    }

    /**
     * @return bool
     */
    public function lock()
    {
        $this->lock = sem_get($this->id);

        return sem_acquire($this->lock);
    }

    /**
     * @return bool
     */
    public function unlock()
    {
        $released = sem_release($this->lock);
        sem_remove($this->lock);
        $this->lock = null;

        return $released;
    }
}
