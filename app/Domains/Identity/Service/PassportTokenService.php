<?php

namespace App\Domains\Identity\Service;

use App\Domains\User\Entities\User\UserEntity;
use App\Models\User;

class PassportTokenService
{
    private function findUser(UserEntity $user)
    {
        $model = User::findOrFail($user->id);

        if (!$model) {
            throw new \Exception('User not found');
        }
        return $model;
    }

    public function createToken(UserEntity $user): string
    {
        $token = $this->findUser($user);

        return $token->createToken('auth_token')->accessToken;
    }

    public function logout(UserEntity $user)
    {
        $model = $this->findUser($user);
        $model->tokens()->delete();
    }
}
