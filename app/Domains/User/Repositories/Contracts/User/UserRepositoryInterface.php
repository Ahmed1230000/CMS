<?php

namespace App\Domains\User\Repositories\Contracts\User;

use App\Domains\User\Entities\User\UserEntity;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */


    public function create(UserEntity $userEntity): UserEntity;

    public function findByEmail(string $email): ?UserEntity;

    public function findById(int $id): ?UserEntity;

    /**
     * @param int $perPage
     * @return UserEntity[]|LengthAwarePaginator
     */

    public function list(int $perPage = 10): LengthAwarePaginator;

    public function delete(int $id): void;
}
