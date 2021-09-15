<?php


namespace TestParser\Interfaces;

use TestParser\Interfaces\DataInterfaces;

interface DatabaseInterface
{
    public function write(DataInterfaces $data) : bool;
}