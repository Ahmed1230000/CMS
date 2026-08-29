<?php

namespace App\Domains\Doctor\Repositories\Contracts\Doctor;

use App\Domains\Doctor\Entities\Doctor\DoctorEntity;

interface DoctorRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index();
    public function show(int $id): DoctorEntity;
    public function create(DoctorEntity $doctorEntity): DoctorEntity;
    public function update(DoctorEntity $doctorEntity): DoctorEntity;
    public function delete(int $id);
}
