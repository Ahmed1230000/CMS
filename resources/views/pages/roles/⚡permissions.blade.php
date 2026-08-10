<?php

use App\Domains\Authorization\DTOs\Roles\SyncRolePermissionsDTO;
use App\Domains\Authorization\UseCases\ListPermissionsUseCase\ListPermissionsUseCase;
use App\Domains\Authorization\UseCases\ShowRoleUseCase\ShowRoleUseCase;
use App\Domains\Authorization\UseCases\SyncRolePermissionsUseCase\SyncRolePermissionsUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    public int $role_id;

    public array $selectedPermissions = [];

    protected ShowRoleUseCase $showRoleUseCase;

    protected ListPermissionsUseCase $listPermissionsUseCase;

    protected SyncRolePermissionsUseCase $syncRolePermissionsUseCase;

    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    public function boot(
        ShowRoleUseCase $showRoleUseCase,
        ListPermissionsUseCase $listPermissionsUseCase,
        SyncRolePermissionsUseCase $syncRolePermissionsUseCase
    ): void {
        $this->showRoleUseCase = $showRoleUseCase;

        $this->listPermissionsUseCase = $listPermissionsUseCase;

        $this->syncRolePermissionsUseCase = $syncRolePermissionsUseCase;
    }

    /*
    |--------------------------------------------------------------------------
    | Mount
    |--------------------------------------------------------------------------
    */

    public function mount(int $id): void
    {
        $this->role_id = $id;

        $role = $this->showRoleUseCase->execute($id);
        
    }

    /*
    |--------------------------------------------------------------------------
    | Role
    |--------------------------------------------------------------------------
    */

    #[Computed]
    public function role()
    {
        return $this->showRoleUseCase->execute($this->role_id);
    }

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    */

    #[Computed]
    public function permissions()
    {
        return $this->listPermissionsUseCase->execute();
    }

    /*
    |--------------------------------------------------------------------------
    | Assign
    |--------------------------------------------------------------------------
    */

    public function assign()
    {
        $data = $this->validate([
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id',
            ],

            'selectedPermissions' => [
                'array',
            ],

            'selectedPermissions.*' => [
                'integer',
                'distinct',
                'exists:permissions,id',
            ],
        ]);

        $this->syncRolePermissionsUseCase->execute(
            SyncRolePermissionsDTO::fromArray([
                'role_id' => $data['role_id'],
                'permissions' => $data['selectedPermissions'],
            ])
        );

        session()->flash(
            'success',
            'Role permissions updated successfully.'
        );

        $this->redirectRoute('roles.list');
    }
};
?>

<div class="max-w-5xl">

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Assign Permissions

            </h1>

            <p class="mt-2 text-slate-500">

                Manage permissions assigned to this role.

            </p>

        </div>

        <a
            href="{{ route('roles.list') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>

    <form wire:submit="assign">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <!-- Role -->

            <div class="border-b border-slate-200 px-8 py-6">

                <p class="text-sm font-medium text-slate-500">

                    Role

                </p>

                <h2 class="mt-1 text-xl font-bold text-slate-800">

                    {{'#'.$this->role->id.' '.$this->role->name }}

                </h2>

            </div>

            <!-- Permissions -->

            <div class="p-8">

                <div class="mb-6">

                    <h3 class="text-lg font-semibold text-slate-800">

                        Permissions

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Select the permissions that should be assigned to this role.

                    </p>

                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    @forelse ($this->permissions as $permission)

                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 p-4 transition hover:bg-slate-50">

                        <input
                            type="checkbox"
                            wire:model="selectedPermissions"
                            value="{{ $permission->id }}"
                            class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                        <div>

                            <p class="font-medium text-slate-800">

                                {{ $permission->name }}

                            </p>

                            <p class="mt-1 text-xs text-slate-500">

                                ID: {{ $permission->id }}

                            </p>

                        </div>

                    </label>

                    @empty

                    <div class="col-span-full rounded-xl border border-dashed border-slate-300 px-6 py-10 text-center">

                        <p class="text-slate-500">

                            No permissions found.

                        </p>

                    </div>

                    @endforelse

                </div>
                <div>
                    {{ $this->permissions->links() }}
                </div>
            </div>

            <!-- Actions -->

            <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('roles.list') }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                    Save Permissions

                </button>

            </div>

        </div>

    </form>

</div>