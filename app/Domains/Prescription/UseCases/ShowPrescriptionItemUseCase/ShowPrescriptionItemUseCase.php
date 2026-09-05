<?php

namespace App\Domains\Prescription\UseCases\ShowPrescriptionItemUseCase;

use App\Domains\Prescription\Repositories\Contracts\PrescriptionItem\PrescriptionItemRepositoryInterface;
use App\Domains\Prescription\DTOs\PrescriptionItem\ShowPrescriptionItemDTO;

class ShowPrescriptionItemUseCase
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

    public function execute(int $id)
    {
        return $this->repository->show($id);
    }
}
