<?php

namespace App\Domains\User\Providers;

use App\Domains\User\Policies\USer\TestPolicy;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Domains\User\Policies\User\UserPolicy;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserDomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Domains\USer\Repositories\Contracts\HashPassword\HashPasswordRepositoryInterface::class,
            \App\Domains\USer\Repositories\Eloquent\HashPassword\HashPasswordEloquentRepository::class
        );
        $this->app->bind(
            \App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface::class,
            \App\Domains\User\Repositories\Eloquent\User\UserEloquentRepository::class
        );
        //
    }

    public function boot(): void
    {
        $this->loadRoutes();
        $this->loadMigrations();


        Gate::policy(User::class, UserPolicy::class);
        //
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
