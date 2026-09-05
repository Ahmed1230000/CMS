<?php

namespace App\Domains\MedicalRecord\UseCases\ListMedicalRecordsUseCase;

use App\Domains\MedicalRecord\Repositories\Contracts\MedicalRecord\MedicalRecordRepositoryInterface;


class ListMedicalRecordsUseCase
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

    public function execute()
    {
        return $this->repository->index();
    }
}
