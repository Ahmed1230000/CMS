<?php

namespace App\Domains\Appointment\UseCases\Appointment;

use App\Domains\Appointment\DTOs\Appointment\AppointmentDTO;
use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Domains\Appointment\Exceptions\Appointment\DoctorNotFoundException;
use App\Domains\Appointment\Exceptions\Appointment\PatientNotFoundException;
use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;
use App\Domains\Department\Repositories\Contracts\Department\DepartmentRepositoryInterface;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;

class CreateAppointmentUseCase
{
    public function __construct(
        protected AppointmentRepositoryInterface $repository,
        protected DoctorRepositoryInterface $doctorRepositoryInterface,
        protected PatientRepositoryInterface $patientRepositoryInterface,
        protected DepartmentRepositoryInterface $departmentRepositoryInterface
    ) {}

    public function execute(AppointmentDTO $dto): AppointmentEntity
    {
        $doctor = $this->doctorRepositoryInterface->find(
            $dto->doctor_id
        );

        $patient = $this->patientRepositoryInterface->find(
            $dto->patient_id
        );

        if (!$doctor) {
            throw new DoctorNotFoundException(
                'The selected doctor was not found.'
            );
        }

        if (!$patient) {
            throw new PatientNotFoundException(
                'The selected patient was not found.'
            );
        }

        $department = $this->departmentRepositoryInterface->find(
            $doctor->department_id
        );

        if (!$department) {
            throw new \RuntimeException(
                'The doctor department was not found.'
            );
        }

        $appointmentEntity = AppointmentEntity::create(
            doctor_id: $doctor->id,
            patient_id: $patient->id,
            department_id: $department->id,
            appointment_date: $dto->appointment_date,
            start_time: $dto->start_time,
            end_time: $dto->end_time,
            reason: $dto->reason,
            notes: $dto->notes,
            created_by: auth()->id(),
        );
        // dd($appointmentEntity);

        return $this->repository->create($appointmentEntity);
    }
}
