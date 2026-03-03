<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\WebsiteController;

class StartDeal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:start_deal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All Deal is Started for Today';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        WebsiteController::dealofday();
        \Log::info("Start Cron is working fine!");
    }
}
