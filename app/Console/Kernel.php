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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call('\App\Http\Helpers\Offboard@leavers')->everyMinute();
        $schedule->call('\App\Http\Controllers\ManagementEmailController@unfinished')->everyMinute();
        //$schedule->call('\App\Http\Controllers\ITController@syncWP')->everyMinute();
        $schedule->call('\App\Http\Controllers\ReturnsController@reminderEmail')->everyMinute();
        $schedule->call('\App\Http\Helpers\Offboard@ScheduleWP')->everyMinute();
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
