<?php

namespace App\Jobs;

use Exception;
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
    public $lineInExcel = 0;
    public $lineTest = 0;
    public ExcelController $instance;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($instance)
    {

        // $this->Excel = $Excel;
        // $this->Excel = new ExcelController();
        $this->instance = $instance;

        $this->queue = 'excel-test';
        $this->delay = now()->addSeconds(0.5);
        // $this->lineInExcel = $this->Excel->line;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->dataTest = '2233123';
        // $this->targetLine =  $this->lineInExcel +5;

        try {
            $res = $this->instance->getData(); //10 > sp one
            // $this->lineTest =  $this->lineTest + 3;
            Log::info($this->instance->line);
            // $this->instance->setLine($this->lineTest);
            Log::info($res);
        } catch (Exception $e) {
            // $res = $this->Excel->getData(); //20 > xuan vinh
            // $res = $this->Excel->getData();
            // $res = $this->Excel->getData();
            // Log::info($e);
        }
    }
}
