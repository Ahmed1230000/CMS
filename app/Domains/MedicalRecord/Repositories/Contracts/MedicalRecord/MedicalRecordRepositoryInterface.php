<?php

namespace App\Domains\MedicalRecord\Repositories\Contracts\MedicalRecord;

use App\Domains\MedicalRecord\Entities\MedicalRecord\MedicalRecordEntity;

interface MedicalRecordRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index();
    public function show(int $id);
    public function create(MedicalRecordEntity $medicalRecordEntity);
    public function update(MedicalRecordEntity $medicalRecordEntity);
    public function find(int $id): ?MedicalRecordEntity;
}
