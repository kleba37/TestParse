<?php


namespace TestParser\Interfaces;
use TestParser\Interfaces\DataInterfaces;

interface ParseInterfaces
{
    public function parse() : Bool;

    public function getData() : array;
}