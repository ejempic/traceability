<?php

namespace App\Console;

use App\Console\Commands\NotifyLoanDuePayments;
use App\Console\Commands\SpotMarketBidMakeWinner;
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
        SpotMarketBidMakeWinner::class,
        NotifyLoanDuePayments::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('spotmarket:award_winners')->everyMinute();
//         $schedule->command('notify:loan_due')->dailyAt('07:00');
         $schedule->command('notify:loan_due')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
