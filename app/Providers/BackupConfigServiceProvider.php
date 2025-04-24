<?php

namespace App\Providers;

use App\Models\CaiDatModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class BackupConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $cd = new CaiDatModel();

        $cd->cau_hinh = CaiDatModel::FILE_NAME_DB;
        $cd = $cd->chiTiet();
        $name = $cd->gia_tri;

        Config::set('backup.destination.filename_prefix', $name);



    }
}
