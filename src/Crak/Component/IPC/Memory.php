<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 * Copyright 2014 Crakmedia
 */

namespace Crak\Component\IPC;

/**
 * Interface Memory
 * @package Crak\Component\IPC
 */
interface Memory
{
    /**
     * @param string $varName
     * @param mixed $value
     */
    public function set($varName, $value);

    /**
     * @param string $varName
     *
     * @return mixed
     */
    public function get($varName);

    /**
     * @param string $varName
     */
    public function del($varName);

    public function clear();

    public function destroy();
}