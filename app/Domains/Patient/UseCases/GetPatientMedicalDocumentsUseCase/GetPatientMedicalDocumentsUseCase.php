<?php

namespace App\Domains\Patient\UseCases\GetPatientMedicalDocumentsUseCase;

use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;


class GetPatientMedicalDocumentsUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private PatientRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $patientId)
    {
        return $this->repository->getMedicalDocuments($patientId);
    }
}
