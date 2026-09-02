<?php

namespace App\Domains\MedicalRecord\UseCases\MedicalRecord;

use App\Domains\MedicalRecord\DTOs\MedicalRecord\MedicalRecordDTO;
use App\Domains\MedicalRecord\Entities\MedicalRecord\MedicalRecordEntity;
use App\Domains\MedicalRecord\Repositories\Contracts\MedicalRecord\MedicalRecordRepositoryInterface;

class UpdateMedicalRecordUseCase
{
    public function __construct(
        protected MedicalRecordRepositoryInterface $repository
    ) {}

    public function execute(
        int $id,
        MedicalRecordDTO $dto
    ): MedicalRecordEntity {

        $medicalRecordEntity = $this->repository->find($id);

        $medicalRecordEntity = $medicalRecordEntity->update([
            'chief_complaint' => $dto->chief_complaint,
            'diagnosis'       => $dto->diagnosis,
            'clinical_notes'  => $dto->clinical_notes,
            'treatment_plan'  => $dto->treatment_plan,
        ]);

        return $this->repository->update(
            $medicalRecordEntity
        );
    }
}
