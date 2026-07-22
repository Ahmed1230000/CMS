<?php

namespace App\Domains\User\Policies\User;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether any models can be viewed.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the model can be viewed.
     */
    public function view(User $user ,User $model): bool
    {
        return true;
    }

    /**
     * Determine whether models can be created.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the model can be updated.
     */
    public function update(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the model can be deleted.
     */
    public function delete(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the model can be restored.
     */
    public function restore(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the model can be permanently deleted.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return true;
    }
}