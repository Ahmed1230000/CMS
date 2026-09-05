<?php

namespace App\Domains\Prescription\UseCases\PrescriptionItem;

use App\Domains\Prescription\DTOs\PrescriptionItem\PrescriptionItemDTO;
use App\Domains\Prescription\Repositories\Contracts\PrescriptionItem\PrescriptionItemRepositoryInterface;

class DeletePrescriptionItemUseCase
{
    public function __construct(
        protected PrescriptionItemRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}