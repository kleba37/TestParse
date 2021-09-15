<?php

namespace TestParser\Classes;

use TestParser\Interfaces\ParseInterfaces;
use TestParser\Classes\Data;
use TestParser\Interfaces\DataInterfaces;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\CssSelector\CssSelectorConverter;

class Parse implements ParseInterfaces
{
    private $data;
    private $url;
    private $selectorMain;
    private $selectorEntry;
    private $selectorText;
    private $selectorHref;
    private $selectorImg;

    public function __construct(
        string $url = "https://www.rbc.ru", string $selectorMain = ".js-news-feed-list",
        string $selectorEntry = ".news-feed__item", string $selectorText = "", string $selectorHref = "", string $selectorImg = "")

    {
        $this->url = $url;
        $this->selectorMain = $selectorMain;
        $this->selectorEntry = $selectorEntry;
        $this->selectorText = $selectorText;
        $this->selectorHref = $selectorHref;
        $this->selectorImg = $selectorImg;
    }

    public function parse(): Bool
    {
        $client = HttpClient::create();
        $request = $client->request('GET', $this->url);

        if ( $request->getStatusCode() != 200 ) return "";

        $crawler = new Crawler($request->getContent());

        $selector = new CssSelectorConverter();
        $query = $selector->toXPath('body ' . $this->selectorMain ." " . $this->selectorEntry);

        $crawler->filterXPath($query)->each(function(Crawler $crawler, $i){
            $el = new Data();
            $el->setLink($crawler->filter($this->selectorHref)->attr("href"));
            $el->setText($crawler->filter($this->selectorText)->text());
            $this->data[] = $el;
        });

        return  true;
    }

    public function getData(): string
    {
        return "";
    }
}