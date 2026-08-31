<?php

namespace App\Domains\Appointment\UseCases\ShowAppointmentUseCase;

use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;


class ShowAppointmentUseCase
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

    public function execute(int $id)
    {
        return $this->repository->show($id);
    }
}
