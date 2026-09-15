<?php

namespace App\Domains\Pharmacy\UseCases\Medicine;

use App\Domains\Pharmacy\DTOs\Medicine\MedicineDTO;
use App\Domains\Pharmacy\Entities\Medicine\MedicineEntity;
use App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface;

class CreateMedicineUseCase
{
    public function __construct(
        protected MedicineRepositoryInterface $repository
    ) {}

    public function execute(MedicineDTO $dto): MedicineEntity
    {
        // TODO: implement business logic
        $medicine = MedicineEntity::create($dto->toArray());

        return $this->repository->create($medicine);
    }
}
