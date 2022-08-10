<?php

namespace App\Http\Controllers;

use Exception;
use App\Jobs\ExcelJob;
use FastSimpleHTMLDom\Document;
use Illuminate\Support\Facades\Log;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ExcelTempClass extends Controller
{
    public $incre = 2;
    public $line = 0;
    public $price = 0;
    public $name;

    // public function __construct($line) {
    //     $this->line = $line;
    // }

    public function storeQueue()
    {
        $instance = new ExcelController($this->line);
        $jobTest = new ExcelJob($instance);
        dispatch($jobTest);
        // $this->incre++;
        $this->line += 3;
    }

    public function totalAdd()
    {
        for ($i = 0; $i < 3; $i++) {
            $this->storeQueue();
        }
        return  $this->line;
    }

    public function setLine($targetLine)
    {
        $this->line = $targetLine;
    }
}
