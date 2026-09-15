<?php

namespace App\Domains\Pharmacy\UseCases\IndexMedicineUseCase;

use App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface;
use App\Domains\Pharmacy\DTOs\Medicine\IndexMedicineDTO;

class IndexMedicineUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private MedicineRepositoryInterface $repository
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
