<?php

namespace App\Domains\Dashboard\UseCases\GetDashboardStatsUseCase;

use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;

class GetDashboardStatsUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private PatientRepositoryInterface $patientRepositoryInterface,
        private DoctorRepositoryInterface $doctorRepositoryInterface,
        private AppointmentRepositoryInterface $appointmentRepositoryInterface,
        private UserRepositoryInterface $userRepositoryInterface,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(): array
    {
        return [
            'users'        => $this->userRepositoryInterface->count(),
            'patients'     => $this->patientRepositoryInterface->count(),
            'doctors'      => $this->doctorRepositoryInterface->count(),
            'appointments' => $this->appointmentRepositoryInterface->count(),
        ];
    }
}
