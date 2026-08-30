<?php

namespace App\Domains\Patient\UseCases\ListPatientsUseCase;

use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;


class ListPatientsUseCase
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

    public function execute()
    {
        return $this->repository->index();
    }
}
