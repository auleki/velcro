<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Sbackup;

class Kernel extends ConsoleKernel
{
    
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\CreateBackups',
        'App\Console\Commands\MonthlyReport',
        'App\Console\Commands\WeeklyReport',
        'App\Console\Commands\DailyReport'
    ];

    

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire') 
        //          ->hourly();
        $setting = Sbackup::whereId(1)->where('status',1)->first();
        if($setting)
        {
           if($setting && $setting->status == true && $setting->interval == 'Yearly')
           {
            $schedule->command('create:backups')->yearly();
           }

           if($setting && $setting->status == true && $setting->interval == 'Monthly' && !is_null($setting->day))
           {
            $schedule->command('create:backups')->monthlyOn($setting->day, '15:00');
           }
           

           if($setting && $setting->status == true && $setting->interval == 'Monthly')
           {
            $schedule->command('create:backups')->monthly();
           }
        }

        $schedule->command('monthly:report')->everyMinute();
        $schedule->command('weekly:report')->everyMinute();
        $schedule->command('daily:report')->everyMinute();
        
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
