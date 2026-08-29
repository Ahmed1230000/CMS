<?php

namespace App\Domains\Employee\UseCases\Employee;

use App\Domains\Employee\DTOs\Employee\EmployeeDTO;
use App\Domains\Employee\Repositories\Contracts\Employee\EmployeeRepositoryInterface;

class DeleteEmployeeUseCase
{
    public function __construct(
        protected EmployeeRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository->delete($id);
    }
}
