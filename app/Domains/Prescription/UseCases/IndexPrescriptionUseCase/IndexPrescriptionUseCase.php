<?php

namespace App\Domains\Prescription\UseCases\IndexPrescriptionUseCase;

use App\Domains\Prescription\Repositories\Contracts\Prescription\PrescriptionRepositoryInterface;
use App\Domains\Prescription\DTOs\Prescription\IndexPrescriptionDTO;

class IndexPrescriptionUseCase
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

    public function execute()
    {
        return $this->repository->index();
    }
}
