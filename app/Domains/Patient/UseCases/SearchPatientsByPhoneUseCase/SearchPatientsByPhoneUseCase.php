<?php

namespace App\Domains\PAtient\UseCases\SearchPatientsByPhoneUseCase;

use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;


class SearchPatientsByPhoneUseCase
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

    public function execute(string $phone)
    {
        return $this->repository->searchByPhone($phone);
    }
}
