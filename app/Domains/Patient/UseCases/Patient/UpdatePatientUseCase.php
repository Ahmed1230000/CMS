<?php

namespace App\Domains\Patient\UseCases\Patient;

use App\Domains\Patient\DTOs\Patient\PatientDTO;
use App\Domains\Patient\Entities\Patient\PatientEntity;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;

class UpdatePatientUseCase
{
    public function __construct(
        protected PatientRepositoryInterface $repository
    ) {}

    public function execute(
        PatientDTO $dto,
        PatientEntity $patientEntity
    ): PatientEntity {
        $patientEntity = $patientEntity->update(
            patient_number: $dto->patient_number,
            name: $dto->name,
            phone: $dto->phone,
            email: $dto->email,
            gender: $dto->gender,
            date_of_birth: $dto->date_of_birth,
            national_id: $dto->national_id,
            address: $dto->address,
            is_active: $dto->is_active,
        );

        return $this->repository->update($patientEntity);
    }
}