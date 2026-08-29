<?php

namespace App\Domains\Department\UseCases\Department;

use App\Domains\Department\DTOs\Department\DepartmentDTO;
use App\Domains\Department\Entities\Department\DepartmentEntity;
use App\Domains\Department\Repositories\Contracts\Department\DepartmentRepositoryInterface;

class UpdateDepartmentUseCase
{
    public function __construct(
        protected DepartmentRepositoryInterface $repository
    ) {}

    public function execute(DepartmentDTO $dto, DepartmentEntity $departmentEntity): DepartmentEntity
    {
        // TODO: implement business logic

        $departmentEntity = $departmentEntity->update(
            name: $dto->name,
            code: $dto->code,
            description: $dto->description,
            is_active: $dto->is_active,
        );

        return $this->repository->update($departmentEntity);
    }
}
