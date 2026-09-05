<?php

namespace App\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class DomainsServiceProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->register(\App\Domains\Prescription\Providers\PrescriptionDomainServiceProvider::class);
        $this->app->register(\App\Domains\MedicalRecord\Providers\MedicalRecordDomainServiceProvider::class);
        $this->app->register(\App\Domains\Appointment\Providers\AppointmentDomainServiceProvider::class);
        $this->app->register(\App\Domains\Patient\Providers\PatientDomainServiceProvider::class);
        $this->app->register(\App\Domains\Employee\Providers\EmployeeDomainServiceProvider::class);
        $this->app->register(\App\Domains\Doctor\Providers\DoctorDomainServiceProvider::class);
        $this->app->register(\App\Domains\Hr\Providers\HrDomainServiceProvider::class);
        $this->app->register(\App\Domains\Department\Providers\DepartmentDomainServiceProvider::class);
        $this->app->register(\App\Domains\Authorization\Providers\AuthorizationDomainServiceProvider::class);
        $this->app->register(\App\Domains\Identity\Providers\IdentityDomainServiceProvider::class);
        $this->app->register(\App\Domains\User\Providers\UserDomainServiceProvider::class);
        $this->app->register(\App\Providers\DomainBindingsServiceProvider::class);
    }

    public function boot() {}
}
