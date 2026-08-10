<?php

namespace App\Domains\Authorization\UseCases\Roles;

use App\Domains\Authorization\DTOs\Roles\RolesDTO;
use App\Domains\Authorization\Entities\Roles\RolesEntity;
use App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface;

class DeleteRolesUseCase
{
    public function __construct(
        protected RolesRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        $role = $this->repository->findById($id);
        
        return $this->repository->delete($role);
    }
}
