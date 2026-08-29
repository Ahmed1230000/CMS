<?php

namespace App\Domains\Department\UseCases\Department;

use App\Domains\Department\DTOs\Department\DepartmentDTO;
use App\Domains\Department\Repositories\Contracts\Department\DepartmentRepositoryInterface;

class DeleteDepartmentUseCase
{
    public function __construct(
        protected DepartmentRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository->delete($id);
    }
}
