<?php

namespace App\Domains\Pharmacy\UseCases\Medicine;

use App\Domains\Pharmacy\DTOs\Medicine\MedicineDTO;
use App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface;

class DeleteMedicineUseCase
{
    public function __construct(
        protected MedicineRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}