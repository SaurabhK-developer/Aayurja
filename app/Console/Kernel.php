<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\StartDeal::class,
        // Commands\EndDeal::class,
        Commands\RunMyFunction::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('command:start_deal')->daily();
                

                //  $schedule->command('command:start_deal')->dailyAt('00:00');
                 $schedule->command('myfunction:run')->daily();
    

                //  $schedule->job(new \App\Jobs\SendAbandonedCartWhatsApp)->everyMinute();
        // $schedule->command('command:end_deal')
        //          ->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
