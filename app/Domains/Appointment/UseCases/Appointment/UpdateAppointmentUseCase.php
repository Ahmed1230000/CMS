<?php

namespace App\Domains\Appointment\UseCases\Appointment;

use App\Domains\Appointment\DTOs\Appointment\AppointmentDTO;
use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;

class UpdateAppointmentUseCase
{
    public function __construct(
        protected AppointmentRepositoryInterface $repository
    ) {}

    public function execute(
        AppointmentDTO $dto,
        AppointmentEntity $appointmentEntity
    ): AppointmentEntity {
        $appointmentEntity = $appointmentEntity->update(
            appointment_date: $dto->appointment_date,
            start_time: $dto->start_time,
            end_time: $dto->end_time,
            reason: $dto->reason,
            notes: $dto->notes,
        );

        return $this->repository->update($appointmentEntity);
    }
}
