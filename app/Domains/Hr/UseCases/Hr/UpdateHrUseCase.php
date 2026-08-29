<?php

namespace App\Domains\Hr\UseCases\Hr;

use App\Domains\Hr\DTOs\Hr\HrDTO;
use App\Domains\Hr\Entities\Hr\HrEntity;
use App\Domains\Hr\Repositories\Contracts\Hr\HrRepositoryInterface;

class UpdateHrUseCase
{
    public function __construct(
        protected HrRepositoryInterface $repository
    ) {}

    public function execute(
        HrDTO $dto,
        HrEntity $hrEntity
    ): HrEntity {
        $hrEntity = $hrEntity->update(
            employee_number: $dto->employee_number,
            name: $dto->name,
            phone: $dto->phone,
            email: $dto->personal_email,
            gender: $dto->gender,
            date_of_birth: $dto->date_of_birth,
            national_id: $dto->national_id,
            address: $dto->address,
            hire_date: $dto->hire_date,
            job_title: $dto->job_title,
            is_active: $dto->is_active,
        );

        return $this->repository->update($hrEntity);
    }
}
