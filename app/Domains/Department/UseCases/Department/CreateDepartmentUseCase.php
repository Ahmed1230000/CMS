<?php

namespace App\Domains\Department\UseCases\Department;

use App\Domains\Department\DTOs\Department\DepartmentDTO;
use App\Domains\Department\Entities\Department\DepartmentEntity;
use App\Domains\Department\Repositories\Contracts\Department\DepartmentRepositoryInterface;

class CreateDepartmentUseCase
{
    public function __construct(
        protected DepartmentRepositoryInterface $repository
    ) {}

    public function execute(DepartmentDTO $dto): DepartmentEntity
    {
        // TODO: implement business logic

        $department = DepartmentEntity::create(
            name: $dto->name,
            code: $dto->code,
            description: $dto->description,
            createdBy: auth()->id(),
        );
        return $this->repository->create($department);
    }
}
