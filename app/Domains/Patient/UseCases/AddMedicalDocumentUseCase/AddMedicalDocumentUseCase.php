<?php

namespace App\Domains\Patient\UseCases\UploadMedicalDocumentUseCase;

use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;
use Illuminate\Http\UploadedFile;

class AddMedicalDocumentUseCase
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

    public function execute(int $patientId, UploadedFile $uploadedFile, int $creatorId)
    {
        return $this->repository->addMedicalDocument($patientId, $uploadedFile, $creatorId);
    }
}
