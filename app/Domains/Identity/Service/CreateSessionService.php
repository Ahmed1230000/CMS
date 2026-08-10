<?php

namespace App\Domains\Identity\Service;

use App\Domains\User\Entities\User\UserEntity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateSessionService
{
    public function login(UserEntity $userEntity): void
    {
        $model = User::findOrFail($userEntity->id);
        Auth::login($model);
        session()->regenerate();
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
