<?php

namespace App\Console;

use App\Actions\DeleteExpiredUserProxies;
use App\Actions\DeleteExpiredPriceTypes;
use App\Actions\DeleteUnusedCategoryAttribute;
use App\Actions\EmailChangedProductPrices;
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
        // Внимание если крон на сервере стучит медленнее чем раз в минуту,
        // Любой заданный интервал будет фактически умножен на интервал
        // серверного крона

//        $schedule->call(new DeleteExpiredPriceTypes())->dailyAt('3:00');
//        $schedule->call(new DeleteExpiredUserProxies())->dailyAt('3:00');
//        $schedule->call(new DeleteUnusedCategoryAttribute())->monthly();
//        $schedule->call(new EmailChangedProductPrices())->cron('0 8,14,20 * * *');
        $schedule->call(new DeleteUnusedCategoryAttribute())->daily();
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
