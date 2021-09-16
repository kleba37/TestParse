<?php


namespace TestParser\Classes;

use TestParser\Interfaces\DataInterfaces;

class Data implements DataInterfaces
{
    private string $head;
    private string $text;
    private string $image;

    public function getImage() : string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function setHead(string $head)
    {
        $this->head = $head;
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

    public function getHead(): string
    {
        return $this->head;
    }
}