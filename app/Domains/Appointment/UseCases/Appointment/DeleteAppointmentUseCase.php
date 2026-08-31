<?php

namespace App\Domains\Appointment\UseCases\Appointment;

use App\Domains\Appointment\DTOs\Appointment\AppointmentDTO;
use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;

class DeleteAppointmentUseCase
{
    public function __construct(
        protected AppointmentRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository->delete($id);
    }
}
