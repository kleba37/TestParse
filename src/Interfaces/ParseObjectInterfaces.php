<?php


namespace TestParser\Interfaces;

use Symfony\Component\CssSelector;
use TestParser\Interfaces\DataObjectInterfaces;

abstract class ParseObjectInterfaces
{
    private $url;
    private $selectorMain;
    private $selectorHead;
    private $selectorText;
    private $data;
    private $limit;

    public function getUrl() : CssSelector\Node\ElementNode
    {
        return $this->url;
    }

    public function getSelectorMain() : CssSelector\Node\ElementNode
    {
        return $this->selectorMain;
    }

    public function getSelectorHead() : CssSelector\Node\ElementNode
    {
        return $this->selectorHead;
    }

    public function getSelectorText() : CssSelector\Node\ElementNode
    {
        return $this->selectorText;
    }
}