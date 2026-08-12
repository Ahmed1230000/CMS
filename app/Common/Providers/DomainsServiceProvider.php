<?php

namespace App\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class DomainsServiceProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->register(\App\Domains\Department\Providers\DepartmentDomainServiceProvider::class);
        $this->app->register(\App\Domains\Authorization\Providers\AuthorizationDomainServiceProvider::class);
        $this->app->register(\App\Domains\Identity\Providers\IdentityDomainServiceProvider::class);
        $this->app->register(\App\Domains\User\Providers\UserDomainServiceProvider::class);
        $this->app->register(\App\Providers\DomainBindingsServiceProvider::class);
    }

    public function boot() {}
}
