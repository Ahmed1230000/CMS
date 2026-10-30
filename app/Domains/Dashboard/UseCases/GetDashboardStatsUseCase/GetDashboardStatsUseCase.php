<?php

namespace App\Domains\Dashboard\UseCases\GetDashboardStatsUseCase;

use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Cache;

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
        $cache = cache::get('dashboard:stats');

        if ($cache !== null) {
            return $cache;
        }

        return cache::lock('dashboard:stats', 10)->block(5, function () {
            $cache = cache::get('dashboard:stats');

            if ($cache !== null) {
                return $cache;
            }
            $status = [
                'users'        => $this->userRepositoryInterface->count(),
                'patients'     => $this->patientRepositoryInterface->count(),
                'doctors'      => $this->doctorRepositoryInterface->count(),
                'appointments' => $this->appointmentRepositoryInterface->count(),
            ];

            cache::put('dashboard:stats', $status, 300);

            return $status;
        });
    }
}
