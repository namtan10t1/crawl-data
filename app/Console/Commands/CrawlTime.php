<?php

namespace App\Console\Commands;

use Exception;
// use Shareable;
use App\Models\Excel;
use App\Traits\Shareable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ExcelController;

class CrawlTime extends Command
{
    // use Shareable;
    public $line = 0;
    // use PushNotificationTrait;

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
        $this->Excel = new Excel();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $line = $this->Excel->getLine(1);
            $res = $this->instance->getData($line);
            $this->Excel->updateLine(1, $line + 3);
            // Log::info($this->instance->line);
            Log::info($res);
        } catch (Exception $e) {
        }
        Log::info("successfully");
    }
}
