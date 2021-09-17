<?php


namespace TestParser\Classes;

use TestParser\Interfaces\DataInterfaces;

class Data implements DataInterfaces
{
    /*
     * Database name = head, type = varchar, length = 200
     */
    private string $head;
    /*
     * Database name = text, type = text
     */
    private string $text;
    /*
     * Database name = image, type = varchar length = 150
     */
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