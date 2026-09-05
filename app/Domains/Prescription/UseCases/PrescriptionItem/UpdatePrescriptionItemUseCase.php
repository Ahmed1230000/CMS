<?php

namespace App\Domains\Prescription\UseCases\PrescriptionItem;

use App\Domains\Prescription\DTOs\PrescriptionItem\PrescriptionItemDTO;
use App\Domains\Prescription\Entities\PrescriptionItem\PrescriptionItemEntity;
use App\Domains\Prescription\Repositories\Contracts\PrescriptionItem\PrescriptionItemRepositoryInterface;

class UpdatePrescriptionItemUseCase
{
    public function __construct(
        protected PrescriptionItemRepositoryInterface $repository
    ) {}

    public function execute(int $id, PrescriptionItemDTO $dto): PrescriptionItemEntity
    {

        $item = $this->repository->find($id);


        $entity = $item->update(
            [
                'prescription_id' => $dto->prescription_id,
                'medication_name' => $dto->medication_name,
                'dosage'          => $dto->dosage,
                'frequency'       => $dto->frequency,
                'duration'        => $dto->duration,
                'instructions'    => $dto->instructions,
            ]
        );

        return $this->repository->update($entity);
    }
}
