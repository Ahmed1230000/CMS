<?php

namespace App\Domains\Prescription\UseCases\IndexPrescriptionItemUseCase;

use App\Domains\Prescription\Repositories\Contracts\PrescriptionItem\PrescriptionItemRepositoryInterface;
use App\Domains\Prescription\DTOs\PrescriptionItem\IndexPrescriptionItemDTO;

class IndexPrescriptionItemUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private PrescriptionItemRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $prescriptionId)
    {
        return $this->repository->index($prescriptionId);
    }
}
