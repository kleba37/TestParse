<?php


namespace TestParser\Interfaces;


abstract class DataObjectInterfaces
{
    private $head;
    private $text;
    private $image;

    public function getHead() : string
    {
        return $this->head;
    }

    public function setHead(string $head)
    {
        $this->head = $head;
    }

    public function getText() : string
    {
        return $this->text;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getImage() : string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }
}