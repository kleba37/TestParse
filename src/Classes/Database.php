<?php

namespace TestParser\Classes;

use TestParser\Interfaces\DatabaseInterface;
use TestParser\Interfaces\DataInterfaces;
use TestParser\Classes\MySqlDatabase;

class Database implements DatabaseInterface
{
    private string $table = "news";
    public function saveImage(string $path) : bool
    {

    }

    public function write(DataInterfaces $data): bool
    {
        $mysql = MySqlDatabase::getInstance()->getConnect();

        $mysql->beginTransaction();

        $mysql->query("INSERT INTO `news` (`head`, `text`, `image`) VALUES ({$data->getHead()}, {$data->getText()}, {$data->getImage()})");

        if ($this->saveImage()){

        }

        $mysql->commit();
        return true;
    }
}