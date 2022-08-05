<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\ExcelController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $Excel;
    public $dataTest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Excel)
    {

        // $this->Excel = $Excel;
        $this->Excel = new ExcelController();
        $this->queue = 'excel-test2';
        $this->delay = now()->addSeconds(2);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->dataTest = '2233123';
        // $html = $this->Excel->store_SP_One;
        $res = $this->Excel->getData(); //10 > sp one
        // $res = $this->Excel->getData(); //20 > xuan vinh
        // $res = $this->Excel->getData();
        // $res = $this->Excel->getData();

        Log::info($res);
    }
}
