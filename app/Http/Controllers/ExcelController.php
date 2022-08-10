<?php

namespace App\Http\Controllers;

use App\Jobs\ExcelJob;
use App\Services\ExcelService;
use App\Traits\PushNotificationTrait;

class ExcelController extends Controller
{
    use PushNotificationTrait;

    public $incre = 2;
    public $line = 0;

    // public function __construct($line) {
    //     $this->line = $line;
    // }

    public function storeQueue()
    {
        $instance = new ExcelService($this->line);
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
