<?php

namespace App\Domains\MedicalRecord\UseCases\ShowMedicalRecordUseCase;

use App\Domains\MedicalRecord\Repositories\Contracts\MedicalRecord\MedicalRecordRepositoryInterface;
use App\Domains\MedicalRecord\DTOs\MedicalRecord\ShowMedicalRecordDTO;

class ShowMedicalRecordUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private MedicalRecordRepositoryInterface $repository
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
