<?php

namespace App\Domains\MedicalRecord\UseCases\MedicalRecord;

use App\Domains\MedicalRecord\DTOs\MedicalRecord\MedicalRecordDTO;
use App\Domains\MedicalRecord\Entities\MedicalRecord\MedicalRecordEntity;
use App\Domains\MedicalRecord\Repositories\Contracts\MedicalRecord\MedicalRecordRepositoryInterface;

class CreateMedicalRecordUseCase
{
    public function __construct(
        protected MedicalRecordRepositoryInterface $repository
    ) {}

    public function execute(MedicalRecordDTO $dto): MedicalRecordEntity
    {
        // TODO: implement business logic
        $medicalRecordEntity = MedicalRecordEntity::create([
            'patient_id'      => $dto->patient_id,
            'chief_complaint' => $dto->chief_complaint,
            'diagnosis'       => $dto->diagnosis,
            'clinical_notes'  => $dto->clinical_notes,
            'treatment_plan'  => $dto->treatment_plan,
            'created_by'      => auth()->user()->id,
        ]);

        return $this->repository->create($medicalRecordEntity);
    }
}
