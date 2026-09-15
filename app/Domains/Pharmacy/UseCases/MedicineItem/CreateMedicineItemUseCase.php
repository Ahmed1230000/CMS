<?php

namespace App\Domains\Pharmacy\UseCases\MedicineItem;

use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemDTO;
use App\Domains\Pharmacy\Entities\MedicineItem\MedicineItemEntity;
use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;

class CreateMedicineItemUseCase
{
    public function __construct(
        protected MedicineItemRepositoryInterface $repository
    ) {}

    public function execute(MedicineItemDTO $dto): MedicineItemEntity
    {
        $medicineItem = MedicineItemEntity::create(
            $dto->toArray()
        );

        return $this->repository->create($medicineItem);
    }
}