<?php

namespace App\Domains\Pharmacy\Repositories\Contracts\Medicine;

use App\Domains\Pharmacy\Entities\Medicine\MedicineEntity;

interface MedicineRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index();
    public function show(int $id);
    public function create(MedicineEntity $medicineEntity): MedicineEntity;
    public function update(MedicineEntity $medicineEntity): MedicineEntity;
    public function find(int $id): MedicineEntity;
    public function findMedicineName(int $id);
}
