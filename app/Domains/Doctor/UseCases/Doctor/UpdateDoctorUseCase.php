<?php

namespace App\Domains\Doctor\UseCases\Doctor;

use App\Domains\Doctor\DTOs\Doctor\DoctorDTO;
use App\Domains\Doctor\Entities\Doctor\DoctorEntity;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;

class UpdateDoctorUseCase
{
    public function __construct(
        protected DoctorRepositoryInterface $repository
    ) {}

    public function execute(
        DoctorDTO $dto,
        DoctorEntity $doctorEntity
    ): DoctorEntity {
        $doctorEntity = $doctorEntity->update(
            department_id: $dto->department_id,
            license_number: $dto->license_number,
            specialization: $dto->specialization,
            phone: $dto->phone,
            email: $dto->personal_email,
            bio: $dto->bio,
            is_active: $dto->is_active,
        );

        return $this->repository->update($doctorEntity);
    }
}
