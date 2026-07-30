<?php

namespace App\Domains\Authorization\UseCases\Permission;

use App\Domains\Authorization\DTOs\Permission\PermissionDTO;
use App\Domains\Authorization\Entities\Permission\PermissionEntity;
use App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface;

class CreatePermissionUseCase
{
    public function __construct(
        protected PermissionRepositoryInterface $repository
    ) {}

    public function execute(PermissionDTO $dto): PermissionEntity
    {
        // TODO: implement business logic
        $permission = PermissionEntity::create($dto->name, $dto->guard_name);

        return $this->repository->create($permission);
    }
}
