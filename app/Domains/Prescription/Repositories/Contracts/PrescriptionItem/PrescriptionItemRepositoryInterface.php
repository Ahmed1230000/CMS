<?php

namespace App\Domains\Prescription\Repositories\Contracts\PrescriptionItem;

use App\Domains\Prescription\Entities\PrescriptionItem\PrescriptionItemEntity;
use App\Domains\Prescription\Mapper\PrescriptionItemMapper;

interface PrescriptionItemRepositoryInterface
{
    public function create(PrescriptionItemEntity $entity): PrescriptionItemEntity;

    public function update(PrescriptionItemEntity $entity): PrescriptionItemEntity;

    public function cancel(PrescriptionItemEntity $entity): void;

    public function index(int $prescriptionId);

    public function show(int $id);

    public function find(int $id): PrescriptionItemEntity;
}
