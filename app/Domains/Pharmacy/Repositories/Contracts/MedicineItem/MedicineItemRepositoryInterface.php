<?php

namespace App\Domains\Pharmacy\Repositories\Contracts\MedicineItem;

use App\Domains\Pharmacy\Entities\MedicineItem\MedicineItemEntity;

interface MedicineItemRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index(int $id);
    public function show(int $id);
    public function create(MedicineItemEntity $medicineItemEntity): MedicineItemEntity;
    public function update(MedicineItemEntity $medicineItemEntity): MedicineItemEntity;
    public function find(int $id): MedicineItemEntity;
    public function search(string $search);
}
