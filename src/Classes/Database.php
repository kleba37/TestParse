<?php

namespace TestParser\Classes;

use Symfony\Component\VarDumper\VarDumper;
use TestParser\Interfaces\DatabaseInterface;
use TestParser\Interfaces\DataInterfaces;
use TestParser\Classes\MySqlDatabase;

class Database implements DatabaseInterface
{
    private string $table = "news";
    private string $pathToUpload = "images";

    public function saveImage(string $path) : bool
    {
        $session = curl_init($path);
        $dir = $_SERVER['DOCUMENT_ROOT'] ."/". $this->pathToUpload;
        $filename = basename($path);
        $fp = fopen($dir. "/".$filename, 'w');

        curl_setopt($session, CURLOPT_FILE, $fp);

        if (!curl_exec($session)) return false;
        curl_close($session);
        fclose($fp);
        return true;
    }

    public function write(DataInterfaces $data): bool
    {
        $mysql = MySqlDatabase::getInstance()->getConnect();

        $mysql->beginTransaction();

        if ($data->getImage()){
            $this->saveImage($data->getImage());
        }

        $q = $mysql->query("INSERT INTO `{$this->table}` (`head`, `text`, `image`) VALUES ('{$data->getHead()}','{$data->getText()}','".basename($data->getImage())."')");
        VarDumper::dump($q);

        if (!$mysql->commit()) return false;
        return true;
    }
}