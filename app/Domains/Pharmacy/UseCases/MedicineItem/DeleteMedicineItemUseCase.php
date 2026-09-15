<?php

namespace App\Domains\Pharmacy\UseCases\MedicineItem;

use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemDTO;
use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;

class DeleteMedicineItemUseCase
{
    public function __construct(
        protected MedicineItemRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}