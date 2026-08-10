<?php

namespace App\Domains\User\UseCases\ListUsersUseCase;

use App\Domains\User\DTOs\User\ListUserDTO;
use App\Domains\User\Entities\User\UserEntity;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ListUsersUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $perPage = 10): LengthAwarePaginator
    {
        $users = $this->repository->list($perPage);

        $users->setCollection(
            $users->getCollection()->map(fn(UserEntity $user) => ListUserDTO::fromEntity($user))
        );
        
        return $users;
    }
}
