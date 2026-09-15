<?php

namespace App\Domains\Pharmacy\UseCases\Medicine;

use App\Domains\Pharmacy\DTOs\Medicine\MedicineDTO;
use App\Domains\Pharmacy\Entities\Medicine\MedicineEntity;
use App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface;

class UpdateMedicineUseCase
{
    public function __construct(
        protected MedicineRepositoryInterface $repository
    ) {}

    public function execute(
        MedicineEntity $medicineEntity,
        MedicineDTO $dto,
    ): MedicineEntity {
        // TODO: implement business logic

        $medicine = $medicineEntity->update($dto->toArray());
        return $this->repository->update($medicine);
    }
}
