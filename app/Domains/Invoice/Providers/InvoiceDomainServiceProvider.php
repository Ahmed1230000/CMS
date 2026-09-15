<?php

namespace App\Domains\Invoice\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class InvoiceDomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Domains\Invoice\Repositories\Contracts\InvoiceItem\InvoiceItemRepositoryInterface::class,
            \App\Domains\Invoice\Repositories\Eloquent\InvoiceItem\InvoiceItemEloquentRepository::class
        );
        $this->app->bind(
            \App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface::class,
            \App\Domains\Invoice\Repositories\Eloquent\Invoice\InvoiceEloquentRepository::class
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