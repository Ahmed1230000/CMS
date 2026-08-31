<?php

namespace App\Domains\Patient\UseCases\ShowPatientUseCase;

use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;


class ShowPatientUseCase
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

    public function execute(int $id)
    {
        return $this->repository->show($id);
    }
}
