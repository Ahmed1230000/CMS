<?php

namespace App\Domains\Authorization\UseCases\Roles;

use App\Domains\Authorization\DTOs\Roles\UpdateRolesDTO;
use App\Domains\Authorization\Entities\Roles\RolesEntity;
use App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface;

class UpdateRolesUseCase
{
    public function __construct(
        protected RolesRepositoryInterface $repository
    ) {}

    public function execute(int $id, UpdateRolesDTO $dto): RolesEntity
    {
        // TODO: implement business logic

        $role = $this->repository->findById($id);

        $updateRole = $role->update($dto->name);

        return $this->repository->update($updateRole);
    }
}
