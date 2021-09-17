<?php

use Symfony\Component\VarDumper\VarDumper;

include_once(__DIR__."/vendor/autoload.php");

use TestParser\Classes\ManagerParse;
use TestParser\Classes\Parse;
use TestParser\Classes\Database;
use TestParser\Classes\MySqlDatabase;

$database = new Database();
$parse = new Parse();

$manager = new ManagerParse($database, $parse);

$manager->add($parse);

$manager->parse();

