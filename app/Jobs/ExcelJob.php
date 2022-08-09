<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use App\Services\ExcelService;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\ExcelController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $lineInExcel = 0;
    public $lineTest = 0;
    // public ExcelController $instance;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->instance = $instance;
        $this->queue = 'excel-test';
        $this->delay = now()->addSeconds(0.5);
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $res = ExcelService::getData();
            // Log::info($this->instance->line);
            Log::info($res);
        } catch (Exception $e) {
        }
    }
}
