<?php

namespace App\Domains\Employee\UseCases\Employee;

use App\Domains\Employee\DTOs\Employee\EmployeeDTO;
use App\Domains\Employee\Entities\Employee\EmployeeEntity;
use App\Domains\Employee\Repositories\Contracts\Employee\EmployeeRepositoryInterface;

class UpdateEmployeeUseCase
{
    public function __construct(
        protected EmployeeRepositoryInterface $repository
    ) {}

    public function execute(
        EmployeeDTO $dto,
        EmployeeEntity $employeeEntity
    ): EmployeeEntity {
        $employeeEntity = $employeeEntity->update(
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

        return $this->repository->update($employeeEntity);
    }
}
