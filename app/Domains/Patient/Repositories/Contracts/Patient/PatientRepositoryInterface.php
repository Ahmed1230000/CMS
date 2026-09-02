<?php

namespace App\Domains\Patient\Repositories\Contracts\Patient;

use App\Domains\Patient\Entities\Patient\PatientEntity;

interface PatientRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index();
    public function show(int $id);
    public function create(PatientEntity $patientEntity): PatientEntity;
    public function update(PatientEntity $patientEntity): PatientEntity;
    public function delete(int $id): void;
    public function find(int $id): ?PatientEntity;

    public function searchByPhone(string $phone);
}
