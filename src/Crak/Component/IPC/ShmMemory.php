<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC;

/**
 * Class ShmMemory
 * @package Crak\Component\IPC
 */
class ShmMemory implements Memory
{
    const SID_VARS = 0;
    const SID_NB_PROCESS = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var resource
     */
    private $memory;

    /**
     * @var array
     */
    private $varNames;

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
        $this->memory = shm_attach($this->id);
        $this->updateNbProcess(+1);
    }

    public function __destruct()
    {
        $this->destroy();
    }

    public function destroy()
    {
        $nbProcess = $this->updateNbProcess(-1);
        if ($nbProcess === 0) {
            shm_remove($this->memory);
        } else {
            shm_detach($this->memory);
        }
    }

    /**
     * @param string $varName
     * @param mixed $value
     */
    public function set($varName, $value)
    {
        $this->loadVars();
        $varId = array_search($varName, $this->varNames);

        if (false === $varId) {
            shm_put_var($this->memory, count($this->varNames) + 2, $value);
            $this->varNames[] = $varName;
            if ($this->lock()) {
                shm_put_var($this->memory, self::SID_VARS, $this->varNames);
                $this->unlock();
            }
        } else if ($this->lock()) {
            if (is_null($value)) {
                shm_remove_var($this->memory, $varId + 2);
                unset($this->varNames[$varId]);
                shm_put_var($this->memory, self::SID_VARS, $this->varNames);
            } else {
                shm_put_var($this->memory, $varId + 2, $value);
            }
            $this->unlock();
        }
    }

    /**
     * @param string $varName
     *
     * @return mixed
     */
    public function get($varName)
    {
        $this->loadVars();
        $varId = array_search($varName, $this->varNames);
        if (false === $varId) {
            return false;
        }

        return shm_get_var($this->memory, $varId + 2);
    }

    /**
     * @param string $varName
     */
    public function del($varName)
    {
        $this->set($varName, null);
    }

    public function clear()
    {
        $nbVars = count($this->varNames);
        for ($i = 2; $i < $nbVars; $i++) {
            $this->del($this->varNames[$i]);
        }
    }

    /**
     * @param int $add
     *
     * @return int
     */
    private function updateNbProcess($add)
    {
        if (!$this->lock()) {
            return 0;
        }

        $nbProcess = 0;
        if (shm_has_var($this->memory, self::SID_NB_PROCESS)) {
            $nbProcess = shm_get_var($this->memory, self::SID_NB_PROCESS);
        }
        $nbProcess += $add;
        shm_put_var($this->memory, self::SID_NB_PROCESS, $nbProcess);
        $this->unlock();

        return $nbProcess;
    }

    /**
     * @return bool
     */
    private function lock()
    {
        $this->lock = sem_get($this->id);

        return sem_acquire($this->lock);
    }

    /**
     * @return bool
     */
    private function unlock()
    {
        return sem_release($this->lock);
    }

    private function loadVars()
    {
        if (!$this->lock()) {
            return;
        }

        if (!shm_has_var($this->memory, self::SID_VARS)) {
            $this->varNames = [];
            shm_put_var($this->memory, self::SID_VARS, $this->varNames);
        } else {
            $this->varNames = shm_get_var($this->memory, self::SID_VARS);
        }

        $this->unlock();
    }
}