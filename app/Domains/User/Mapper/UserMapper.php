<?php

namespace App\Domains\User\Mapper;

use App\Domains\User\Entities\User\UserEntity;
use App\Models\User;

class UserMapper
{
    public static function toEntity(User $user): UserEntity
    {
        return UserEntity::reconstitute([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'password' => $user->password,
            'remember_token' => $user->remember_token,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ]);
    }
}
