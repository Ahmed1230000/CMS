<?php

namespace App\Domains\Authorization\Providers;

use App\Models\Permission;
use App\Domains\Authorization\Policies\Permission\PermissionPolicy;

use Illuminate\Support\Facades\Gate;
use App\Models\Roles;
use App\Domains\Authorization\Policies\Roles\RolesPolicy;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AuthorizationDomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface::class,
            \App\Domains\Authorization\Repositories\Eloquent\Permission\PermissionEloquentRepository::class
        );
        $this->app->bind(
            \App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface::class,
            \App\Domains\Authorization\Repositories\Eloquent\Roles\RolesEloquentRepository::class
        );
        //
    }

    public function boot(): void
    {
        Gate::policy(Permission::class, PermissionPolicy::class);
        Gate::policy(Roles::class, RolesPolicy::class);
        
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