<?php

include_once(__DIR__."/vendor/autoload.php");

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\CssSelector\CssSelectorConverter;

$url = "https://www.rbc.ru/";
$client = HttpClient::create();
$request = $client->request('GET', $url);

if ( $request->getStatusCode() != 200 ) die("Error\nStatus code: " . $request->getStatusCode());

$selector = new CssSelectorConverter();

$crawler = new Crawler($request->getContent());

$data = $crawler->filter('.js-news-feed-list > a');

foreach($data->children()->getIterator() as $news){
    var_dump($news);
}

