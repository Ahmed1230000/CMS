<?php

namespace App\Domains\Prescription\UseCases\ShowPrescriptionUseCase;

use App\Domains\Prescription\Repositories\Contracts\Prescription\PrescriptionRepositoryInterface;


class ShowPrescriptionUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private PrescriptionRepositoryInterface $repository
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
