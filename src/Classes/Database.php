<?php

namespace TestParser\Classes;

use TestParser\Interfaces\DatabaseInterface;
use TestParser\Interfaces\DataInterfaces;

class Database implements DatabaseInterface
{

    public function write(DataInterfaces $data): bool
    {
        return true;
    }
}