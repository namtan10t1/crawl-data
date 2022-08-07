<?php

namespace App\Http\Controllers;

use App\Jobs\ExcelJob;
use FastSimpleHTMLDom\Document;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ExcelController extends Controller
{
  public $incre = 2;
  public $price = 0;
  public function storeQueue()
  {
    $Excel = '123123';
    $jobTest = new ExcelJob($Excel);
    dispatch($jobTest);
    $this->incre++;
    return 1;
    // $this->getData();
  }


  /**
   * Get data from XML handle
   *
   * @return array
   */

  public function getData()
  {
    echo $this->incre;
    $store_SP_One = 'Sp-One';
    $store_XV = 'Xuân Vinh';
    $store_PV = 'Phong Vũ';
    $store_PHILONG = 'Phi Long';
    $store_AP = 'An Phát';
    $store_HN = 'HÀ NỘI';
    $store_GEARVN = 'Gearvn';
    $store_PA = 'Phúc Anh';

    var_dump(('Time start: ' . date("Y-m-d H:i:s")));
    echo "<br>";

    $filePath = public_path() . '/link.xlsx';

    $reader = ReaderEntityFactory::createReaderFromFile($filePath);

    $reader->open($filePath);
    $data = [];
    $store = [];

    foreach ($reader->getSheetIterator() as $sheet) {
      foreach ($sheet->getRowIterator() as $i => $row) {
        // dd($row);
        // $cells = $row->getCells();
        // dd($cells);
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $item = $row->toArray();
        $product = [];

        if ($i == 1) {
          foreach ($item as $key => $value) {
            if (!empty($value) && !in_array($key, [0, 1])) {
              $store[$value] = $key;
            };
          }
        } else {
          if (empty($store)) exit;
          if (!isset($item[0]) || !isset($item[1]) || count($item) <= 2) continue;

          $product['ID'] = $item[0];
          $product['Name'] = $item[1];
          $links = [];
          $prices = [];
          // $price = 0;

          // foreach ($store as $storeKey => $storeValue) {
          // dd(array_search($storeValue, $store));
          // $url = $item[$storeValue];
          // dd(count($store));
          // if ($this->incre > count($store)) return;
          $url = $item[$this->incre];
          $nameStore = array_search($this->incre, $store);

          $links[$nameStore] = $url;

          if (!empty($url)) {

            $file_headers = @get_headers($url);
            if ($file_headers && !str_contains($file_headers[0], 'HTTP/1.1 404') && !str_contains($file_headers[0], 'HTTP/1.1 301')) {
              $html = Document::file_get_html($url, false, null, 0);
              switch (strtoupper($nameStore)) {
                case strtoupper($store_SP_One);
                  $prices[$nameStore] = $this->getPriceSPOne($html);
                  break;
                case strtoupper($store_XV);
                  $prices[$nameStore] = $this->getPriceXV($html);
                  break;
                case strtoupper($store_PV);
                  $prices[$nameStore] = $this->getPricePV($html);
                  break;
                case strtoupper($store_PHILONG);
                  $prices[$nameStore] = $this->getPricePL($html);
                  break;
                case strtoupper($store_AP);
                  $prices[$nameStore] = $this->getPriceAP($html);
                  break;
                case strtoupper($store_HN);
                  $prices[$nameStore] = $this->getPriceHN($html);
                  break;
                case strtoupper($store_GEARVN);
                  $prices[$nameStore] = $this->getPriceGearVN($html);
                  break;
                case strtoupper($store_PA);
                  $prices[$nameStore] = $this->getPricePA($html);
                  break;
              }
              // $prices[$nameStore] = $this->price;
              // echo $nameStore;
              $product['links'] = $links;
              $product['prices'] = $prices;
              $data[] = $product;
              echo "<pre>";
              // print_r($data);

              // return $data;
            } else {
              echo "<pre>";
              echo $url;
              print_r($file_headers[0]);
            }
          } else {
            echo "<pre>";
            echo $url;
          }
          // $this->incre++;


          // $prices[$storeKey] = $price;
          // $i++;
          // // }

          $product['links'] = $links;
          $product['prices'] = $prices;
          $data[] = $product;
        }
      }
    }

    $reader->close();
    var_dump('Time end: ' . date("Y-m-d H:i:s"));
    echo "<br>";

    echo "<pre>";
    // return ($data);
    echo "<br>";
    // exit;
  }

  /**
   * Get price Sp-One from URL handle
   *
   * @return array
   */

  public function getPriceSPOne($html)
  {
    $price = 0;
    foreach ($html->find('div.oneshop-single-product-price') as $e) {

      foreach ($e->find('div.regular-price') as $e2) {

        $price = $e2->find('span', 1);
        $price = $price->innertext;
      }
    }
    // echo $price;

    return $price;
  }

  /**
   * Get price Xuan-Vinh from URL handle
   *
   * @return array
   */

  public function getPriceXV($html)
  {
    $price = 0;
    foreach ($html->find('div.price-box') as $e) {

      foreach ($e->find('div.special-price') as $e2) {

        $price = $e2->find('span', 0);
        $price = $price->innertext;
      }
    }

    return $price;
  }

  /**
   * Get price Phong-Vu from URL handle
   *
   * @return array
   */

  public function getPricePV($html)
  {
    $price = 0;
    foreach ($html->find('div.css-1q5zfcu') as $e) {

      $price = $e->find('div.css-casirz');
      $price = $price->innertext;
    }

    return $price;
  }

  /**
   * Get price Phi-Long from URL handle
   *
   * @return array
   */

  public function getPricePL($html)
  {
    $price = 0;
    $price = str_replace('0', 'Liên hệ', $price);
    // dd($price);
    foreach ($html->find('div.entry-summary') as $e) {

      $price = $e->find('span.p-price', 0)->find('span', 1);
      $price = $price->innertext;
    }

    return $price;
  }

  /**
   * Get price An-Phat from URL handle
   *
   * @return array
   */

  public function getPriceAP($html)
  {
    $price = 0;
    foreach ($html->find('div.pro_info-price-container') as $e) {

      $price = $e->find('b.js-pro-total-price', 0);
      $price = $price->innertext;
    }

    return $price;
  }

  /**
   * Get price Ha-Noi from URL handle
   *
   * @return array
   */

  public function getPriceHN($html)
  {
    $price = 0;
    foreach ($html->find('div#product-info-price') as $e) {

      $price = $e->find('strong#js-pd-price');
      $price = $price->innertext;
    }

    return $price;
  }

  /**
   * Get price GEARVN from URL handle
   *
   * @return array
   */

  public function getPriceGearVN($html)
  {
    $price = 0;
    foreach ($html->find('div.product_sales_off') as $e) {
      $price = $e->find('span.product_sale_price', 0);
      $price = $price->innertext;
    }

    return $price;
  }

  /**
   * Get price Phuc-Anh from URL handle
   *
   * @return array
   */

  public function getPricePA($html)
  {
    $price = 0;
    foreach ($html->find('span.detail-product-best-price') as $e) {
      $price = $e->innertext;
    }

    return $price;
  }
}
