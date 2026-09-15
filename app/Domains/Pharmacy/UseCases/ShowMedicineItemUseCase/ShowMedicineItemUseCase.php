<?php

namespace App\Domains\Pharmacy\UseCases\ShowMedicineItemUseCase;

use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;
use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemShowDTO;

class ShowMedicineItemUseCase
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
        return $this->repository->show($id);
    }
}
