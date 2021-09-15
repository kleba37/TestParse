<?php

namespace TestParser\Classes;

use Symfony\Component\VarDumper\VarDumper;
use TestParser\Interfaces\ParseInterfaces;
use TestParser\Interfaces\DatabaseInterface;

class ManagerParse
{
    private $m_parse;
    private $database;

    public function setDatabase(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public function add(ParseInterfaces $parse){
        $this->m_parse[] = $parse;
    }

    public function parse(){
        if (!$this->m_parse) return;
        foreach ($this->m_parse as $p) {
            $p->parse();
        }
    }

    public function write(){
        $this->database->write();
    }

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }
}