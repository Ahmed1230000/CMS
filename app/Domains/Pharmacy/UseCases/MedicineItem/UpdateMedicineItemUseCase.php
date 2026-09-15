<?php

namespace App\Domains\Pharmacy\UseCases\MedicineItem;

use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemDTO;
use App\Domains\Pharmacy\Entities\MedicineItem\MedicineItemEntity;
use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;

class UpdateMedicineItemUseCase
{
    public function __construct(
        protected MedicineItemRepositoryInterface $repository
    ) {}

    public function execute(
        int $id,
        MedicineItemDTO $dto
    ): MedicineItemEntity {
        $medicineItem = $this->repository->find($id);

        $medicineItem = $medicineItem->update(
            $dto->toArray()
        );

        return $this->repository->update($medicineItem);
    }
}
