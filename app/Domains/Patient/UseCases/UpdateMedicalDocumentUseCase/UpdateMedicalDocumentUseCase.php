<?php

namespace App\Domains\Patient\UseCases\UpdateMedicalDocumentUseCase;

use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;
use Illuminate\Http\UploadedFile;

class UpdateMedicalDocumentUseCase
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

    public function execute(int $patientId, int $mediaId, UploadedFile $uploadedFile)
    {
        return $this->repository->updateMedicalDocument($patientId, $mediaId, $uploadedFile);
    }
}
