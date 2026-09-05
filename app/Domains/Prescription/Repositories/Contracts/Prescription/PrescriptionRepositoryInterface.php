<?php

namespace App\Domains\Prescription\Repositories\Contracts\Prescription;

use App\Domains\Prescription\Entities\Prescription\PrescriptionEntity;

interface PrescriptionRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index();
    public function show(int $id);

    public function findActiveByAppointment(int $appointmentId): ?PrescriptionEntity;
    public function create(PrescriptionEntity  $prescriptionEntity): PrescriptionEntity;
}
