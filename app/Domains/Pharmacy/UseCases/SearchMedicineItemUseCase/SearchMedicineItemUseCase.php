<?php

namespace App\Domains\Pharmacy\UseCases\SearchMedicineItemUseCase;

use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;
use App\Domains\Pharmacy\DTOs\MedicineItem\SearchMedicineItemDTO;

class SearchMedicineItemUseCase
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

    public function execute(SearchMedicineItemDTO $dto)
    {
        return $this->repository->search($dto->search);
    }
}
