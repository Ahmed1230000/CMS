<?php

namespace App\Domains\Authorization\Policies\Permission;

use App\Models\User;
use App\Models\Permission;

class PermissionPolicy
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
    public function view(User $user ,Permission $permission): bool
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
    public function update(User $user, Permission $permission): bool
    {
        return true;
    }

    /**
     * Determine whether the model can be deleted.
     */
    public function delete(User $user, Permission $permission): bool
    {
        return true;
    }

    /**
     * Determine whether the model can be restored.
     */
    public function restore(User $user, Permission $permission): bool
    {
        return true;
    }

    /**
     * Determine whether the model can be permanently deleted.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
        return true;
    }
}