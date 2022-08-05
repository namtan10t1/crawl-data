<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Symfony\Component\Panther\Client;

class ScraperController extends Controller
{
    public function Scraper()
    {
        $httpClient = \Symfony\Component\Panther\Client::createChromeClient();
        // for a Firefox client use the line below instead
        //$httpClient = \Symfony\Component\Panther\Client::createFirefoxClient();
        // get response
        dd(123213);
        $response = $httpClient->get('https://books.toscrape.com/');
        // take screenshot and store in current directory
        $response->takeScreenshot($saveAs = 'books_scrape_homepage.jpg');
        // let's display some book titles
        $response->getCrawler()->filter('.row li article h3 a')->each(function ($node) {
            echo $node->text() . PHP_EOL;
        });
    }
}
