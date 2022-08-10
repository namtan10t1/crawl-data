<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ExcelController;

class CrawlTime extends Command
{
    public ExcelController $instance;
    // $instance = new ExcelController();

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:hours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->instance = new ExcelController('');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $res = $this->instance->getData();
            // Log::info($this->instance->line);
            Log::info($res);
        } catch (Exception $e) {
        }
        Log::info("successfully");
    }
}
