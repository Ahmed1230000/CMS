<?php

namespace App\Domains\User\Repositories\Eloquent\User;

use App\Domains\User\DTOs\User\UserDTO;
use App\Domains\User\Entities\User\UserEntity;
use App\Domains\User\Mapper\UserMapper;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;
use App\Models\User;
use Override;

class UserEloquentRepository implements UserRepositoryInterface
{
    public function create(UserEntity $userEntity): UserEntity
    {
        $user =  User::create(
            [
                'name'     => $userEntity->name,
                'email'    => $userEntity->email->value(),
                'password' => $userEntity->password->value(),
            ]
        );
        return UserMapper::toEntity($user);
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $user = User::where('email', $email)->first();
        return $user ? UserMapper::toEntity($user) : null;
    }

    #[Override]
    public function findById(int $id): ?UserEntity
    {
        $user = User::findOrFail($id);
        return $user ? UserMapper::toEntity($user) : null;
    }
}
