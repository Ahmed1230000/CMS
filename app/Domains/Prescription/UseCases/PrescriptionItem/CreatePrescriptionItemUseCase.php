<?php

namespace App\Domains\Prescription\UseCases\PrescriptionItem;

use App\Domains\Prescription\DTOs\PrescriptionItem\PrescriptionItemDTO;
use App\Domains\Prescription\Entities\PrescriptionItem\PrescriptionItemEntity;
use App\Domains\Prescription\Repositories\Contracts\PrescriptionItem\PrescriptionItemRepositoryInterface;

class CreatePrescriptionItemUseCase
{
    public function __construct(
        protected PrescriptionItemRepositoryInterface $repository
    ) {}

    public function execute(PrescriptionItemDTO $dto): PrescriptionItemEntity
    {
        $entity = PrescriptionItemEntity::create(
            $dto->toArray()
        );

        return $this->repository->create($entity);
    }
}
