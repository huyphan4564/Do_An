<?php

namespace App\Console;

use App\Models\CaiDatModel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $cd = new CaiDatModel();
        $cd->cau_hinh = CaiDatModel::TIME_BACKUP_DB;
        $cd = $cd->chiTiet();
        $time = $cd->gia_tri;

        $schedule->command('backup:run --only-db')->cron($time);
        $schedule->command('backup:clean')->cron($time);

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
