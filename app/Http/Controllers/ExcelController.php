<?php

namespace App\Http\Controllers;

use Exception;
use App\Jobs\ExcelJob;
use FastSimpleHTMLDom\Document;
use Illuminate\Support\Facades\Log;
use App\Traits\PushNotificationTrait;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ExcelController extends Controller
{
    use PushNotificationTrait;

    public $incre = 2;
    public $line = 0;

    public function storeQueue()
    {
        // $instance = new ExcelController($this->line);
        $jobTest = new ExcelJob();
        dispatch($jobTest);
        // $this->incre++;
        $this->line += 3;
    }

    public function totalAdd()
    {
        for ($i = 0; $i < 1000; $i++) {
            $this->storeQueue();
        }
        return  $this->line;
    }

    public function setLine($targetLine)
    {
        $this->line = $targetLine;
    }

}
