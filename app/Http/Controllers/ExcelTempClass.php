<?php

namespace App\Http\Controllers;

use Exception;
use Goutte\Client;
use App\Jobs\ExcelJob;
use FastSimpleHTMLDom\Document;
use Illuminate\Support\Facades\Log;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ExcelTempClass extends Controller
{
    // public $incre = 2;
    // public $line = 0;
    // public $price = 0;
    // public $name;

    // // public function __construct($line) {
    // //     $this->line = $line;
    // // }

    // public function storeQueue()
    // {
    //     $instance = new ExcelController($this->line);
    //     $jobTest = new ExcelJob($instance);
    //     dispatch($jobTest);
    //     // $this->incre++;
    //     $this->line += 3;
    // }

    // public function totalAdd()
    // {
    //     for ($i = 0; $i < 1000; $i++) {
    //         $this->storeQueue();
    //     }
    //     return  $this->line;
    // }

    // public function setLine($targetLine)
    // {
    //     $this->line = $targetLine;
    // }

    public function getPricePV()
    {
        // dd(123123);
        // $url = 'https://tinhocngoisao.com/mainboard-asrock-z490-taichi-z490-taichi';
        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        // exit;
        $httpClient = new \Goutte\Client();
        $crawler = $httpClient->request('GET', 'https://tinhocngoisao.com/mainboard-asrock-z490-taichi-z490-taichi');
        $crawler->filter('.entry-summary .woocommerce-Price-amount')->each(function ($node) {
            $price = str_replace("₫", "", $node->text());
            $price = str_replace(",", "", $price);
            var_dump($price);
        });
    }
}
