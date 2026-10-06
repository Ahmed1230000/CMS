<?php

namespace App\Domains\Appointment\Providers;

use Illuminate\Support\Facades\Event;
use App\Domains\Appointment\Events\Appointment\CreateAppointmentEvent;
use App\Domains\Appointment\Listeners\Appointment\CreateAppointmentListener;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppointmentDomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface::class,
            \App\Domains\Appointment\Repositories\Eloquent\Appointment\AppointmentEloquentRepository::class
        );
        //
    }

    public function boot(): void
    {
        Event::listen(
            CreateAppointmentEvent::class,
            CreateAppointmentListener::class
        );
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