<?php

namespace App\Domains\User\Providers;

use App\Domains\User\Policies\USer\TestPolicy;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Domains\User\Policies\User\UserPolicy;

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
        Gate::policy(User::class, TestPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        //
    }
}