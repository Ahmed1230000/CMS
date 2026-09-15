<?php

namespace App\Domains\Pharmacy\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PharmacyDomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface::class,
            \App\Domains\Pharmacy\Repositories\Eloquent\MedicineItem\MedicineItemEloquentRepository::class
        );
        $this->app->bind(
            \App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface::class,
            \App\Domains\Pharmacy\Repositories\Eloquent\Medicine\MedicineEloquentRepository::class
        );
        //
    }

    public function boot(): void
    {
        $this->loadRoutes();
        $this->loadMigrations();
    }


    protected function loadRoutes(): void
    {
        if (file_exists(__DIR__ . '/../Routes/api/api.php')) {
            Route::prefix('api')
                ->middleware('api')
                ->group(__DIR__ . '/../Routes/api/api.php');
        }

        if (file_exists(__DIR__ . '/../Routes/web/web.php')) {
            Route::middleware('web')
                ->group(__DIR__ . '/../Routes/web/web.php');
        }
    }

    protected function loadMigrations(): void
    {
        if (is_dir(__DIR__ . '/../Database/Migrations')) {
            $this->loadMigrationsFrom(
                __DIR__ . '/../Database/Migrations'
            );
        }
    }
}