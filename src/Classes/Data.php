<?php


namespace TestParser\Classes;

use TestParser\Interfaces\DataInterfaces;

class Data implements DataInterfaces
{
    private $link;
    private $text;

    public function setLink(string $link)
    {
        $this->link = $link;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getShortText(): string
    {
        return mb_strimwidth($this->text, 0 , 200) ;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}