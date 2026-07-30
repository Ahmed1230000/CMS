<?php

namespace App\Domains\Authorization\UseCases\Roles;

use App\Domains\Authorization\DTOs\Roles\RolesDTO;
use App\Domains\Authorization\Entities\Roles\RolesEntity;
use App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface;

class CreateRolesUseCase
{
    public function __construct(
        protected RolesRepositoryInterface $repository
    ) {}

    public function execute(RolesDTO $dto): RolesEntity
    {
        // TODO: implement business logic

        $entity = RolesEntity::create(
            $dto->name,
            $dto->guard_name
        );
        return  $this->repository->create($entity);
    }
}
