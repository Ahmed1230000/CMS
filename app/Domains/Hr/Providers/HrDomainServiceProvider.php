<?php

namespace App\Domains\Hr\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class HrDomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Domains\Hr\Repositories\Contracts\Hr\HrRepositoryInterface::class,
            \App\Domains\Hr\Repositories\Eloquent\Hr\HrEloquentRepository::class
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