<?php

namespace App\Domains\Appointment\UseCases\ListAppointmentsUseCase;

use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;


class ListAppointmentsUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private AppointmentRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute()
    {
        return $this->repository->index();
    }
}
