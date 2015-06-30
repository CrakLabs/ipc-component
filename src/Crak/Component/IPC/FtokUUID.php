<?php
/**
 * Created by PhpStorm.
 * User: bcolucci
 * Date: 10/10/14
 * Time: 10:14 AM
 */

namespace Crak\Component\IPC;


class FtokUUID implements UUIDInterface
{
    /**
     * @var int
     */
    private $uuid;

    /**
     * @var string
     */
    private $filename;

    /**
     * @param int $uuid
     * @param string $filename
     */
    public function __construct($uuid, $filename)
    {
        $this->uuid = $uuid;
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->uuid;
    }
} 
