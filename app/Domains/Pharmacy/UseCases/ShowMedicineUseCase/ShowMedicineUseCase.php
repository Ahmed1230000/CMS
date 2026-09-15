<?php

namespace App\Domains\Pharmacy\UseCases\ShowMedicineUseCase;

use App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface;
use App\Domains\Pharmacy\DTOs\Medicine\ShowMedicineDTO;

class ShowMedicineUseCase
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

    public function execute(int $id)
    {
        return $this->repository->show($id);
    }
}
