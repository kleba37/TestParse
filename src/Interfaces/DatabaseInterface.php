<?php


namespace TestParser\Interfaces;

use TestParser\Interfaces\DataObjectInterfaces;

interface DatabaseInterface
{
    public function write(DataObjectInterfaces $data);
}