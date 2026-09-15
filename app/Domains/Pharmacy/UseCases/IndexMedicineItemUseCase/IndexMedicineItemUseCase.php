<?php

namespace App\Domains\Pharmacy\UseCases\IndexMedicineItemUseCase;

use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;
use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemIndexDTO;

class IndexMedicineItemUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private MedicineItemRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $id)
    {
        return $this->repository->index($id);
    }
}
