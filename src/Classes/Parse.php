<?php

namespace TestParser\Classes;

use http\Exception\BadUrlException;
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
        string $url = "https://www.rbc.ru", string $selectorMainLinks = ".js-news-feed-list",
        string $selectorEntryLinks = ".news-feed__item", string $selectorHref = "", string $selectorEntryArticle = ".article",
        string $selectorHead = ".article__header__title", string $selectorText = ".article__text", string $selectorImg = ".article__main-image__wrap img")

    {
        $this->url = $url;
        $this->selectorMainLinks = $selectorMainLinks;
        $this->selectorEntryLinks = $selectorEntryLinks;
        $this->selectorEntryArticle = $selectorEntryArticle;
        $this->selectorHead = $selectorHead;
        $this->selectorText = $selectorText;
        $this->selectorHref = $selectorHref;
        $this->selectorImg = $selectorImg;
    }

    public function getContent(string $url) : Crawler
    {
        $client = HttpClient::create();
        $request = $client->request('GET', $url);

        if ( $request->getStatusCode() != 200 ) return "";

        $crawler = new Crawler($request->getContent());

        return $crawler;
    }

    public function parse(): Bool
    {
        $selector = new CssSelectorConverter();
        $brief = $selector->toXPath("body " . $this->selectorMainLinks ." " . $this->selectorEntryLinks . " " . $this->selectorHref);
        $content = $this->getContent($this->url);
        $content->filterXPath($brief)->each(function(Crawler $crawler){
            $sa = new CssSelectorConverter();
            $url = $crawler->filter($this->selectorHref)->attr("href");
            $content = $this->getContent($url);
            $selectorArticle = $sa->toXPath("body " . $this->selectorEntryArticle);
            $article = $content->filterXPath($selectorArticle);

            if (!$article->count()) return false;

            $el = new Data();
            $head = $article->filter($this->selectorHead)->count() ? $article->filter($this->selectorHead)->text() : "";
            $text = $article->filter($this->selectorText)->count() ? $article->filter($this->selectorText)->text() : "";
            $image = $article->filter($this->selectorImg)->count() ? $article->filter($this->selectorImg)->image()->getUri() : "";

            $el->setHead($head);
            $el->setText($text);
            $el->setImage($image);

            $this->data[] = $el;
        });
        return true;
    }

    public function getData(): array
    {
        return $this->data;
    }
}