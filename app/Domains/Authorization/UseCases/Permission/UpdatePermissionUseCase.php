<?php

namespace App\Domains\Authorization\UseCases\Permission;

use App\Domains\Authorization\DTOs\Permission\PermissionDTO;
use App\Domains\Authorization\Entities\Permission\PermissionEntity;
use App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface;

class UpdatePermissionUseCase
{
    public function __construct(
        protected PermissionRepositoryInterface $repository
    ) {}

    public function execute(int $id, PermissionDTO $dto): PermissionEntity
    {
        // TODO: implement business logic
        $permission = $this->repository->findById($id);

        $permission = $permission->update($dto->name);

        return $this->repository->update($permission);
    }
}
