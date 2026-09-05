<?php

namespace App\Domains\Prescription\UseCases\Prescription;

use App\Domains\Prescription\DTOs\Prescription\PrescriptionDTO;
use App\Domains\Prescription\Entities\Prescription\PrescriptionEntity;
use App\Domains\Prescription\Repositories\Contracts\Prescription\PrescriptionRepositoryInterface;

class CreatePrescriptionUseCase
{
    public function __construct(
        protected PrescriptionRepositoryInterface $repository
    ) {}

    public function execute(PrescriptionDTO $dto): PrescriptionEntity
    {
        // TODO: implement business logic
        $existingPrescription =  $this->repository->findActiveByAppointment($dto->appointment_id);

        if ($existingPrescription) {
            return $existingPrescription;
        } 


        $prescription = PrescriptionEntity::create([
            'patient_id'     => $dto->patient_id,
            'doctor_id'      => $dto->doctor_id,
            'appointment_id' => $dto->appointment_id,
            'created_by'     => auth()->user()->id,
        ]);

        return $this->repository->create($prescription);
    }
}
