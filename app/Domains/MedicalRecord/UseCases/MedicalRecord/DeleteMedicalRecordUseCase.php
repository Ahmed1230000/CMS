<?php

namespace App\Domains\MedicalRecord\UseCases\MedicalRecord;

use App\Domains\MedicalRecord\DTOs\MedicalRecord\MedicalRecordDTO;
use App\Domains\MedicalRecord\Repositories\Contracts\MedicalRecord\MedicalRecordRepositoryInterface;

class DeleteMedicalRecordUseCase
{
    public function __construct(
        protected MedicalRecordRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}