<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EndDeal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:end_deal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All Deal is End for Today';

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
        \Log::info("End Cron is working fine!");
    }
}
