<?php

namespace App\Domains\User\Repositories\Eloquent\User;

use App\Domains\User\DTOs\User\UserDTO;
use App\Domains\User\Entities\User\UserEntity;
use App\Domains\User\Mapper\UserMapper;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;
use App\Models\User;

class UserEloquentRepository implements UserRepositoryInterface
{
    public function create(UserDTO $userDTO): UserEntity
    {
        $user =  User::create(
            [
                'name'     => $userDTO->name,
                'email'    => $userDTO->email,
                'password' => $userDTO->password,
            ]
        );
        $user->save();
        return UserMapper::toEntity($user);
    }
}
