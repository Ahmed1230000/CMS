<?php

namespace App\Domains\Authorization\UseCases\Permission;

use App\Domains\Authorization\DTOs\Permission\PermissionDTO;
use App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface;

class DeletePermissionUseCase
{
    public function __construct(
        protected PermissionRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $permission = $this->repository->findById($id);

        $this->repository->delete($permission);

    }
}