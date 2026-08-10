<?php

use App\Domains\Authorization\UseCases\ListRolesUseCase\ListRolesUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ListRolesUseCase $listRolesUseCase;

    public function boot(ListRolesUseCase $listRolesUseCase): void
    {
        $this->listRolesUseCase = $listRolesUseCase;
    }

    #[Computed]
    public function roles()
    {
        return $this->listRolesUseCase->execute();
    }
};
?>

<div>

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Roles

            </h1>

            <p class="mt-2 text-slate-500">

                Manage all system roles.

            </p>

        </div>

        <a
            href="{{ route('roles.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create Role

        </a>

    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold">

                        #ID

                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">

                        Name

                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">

                        Created At

                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">

                        Updated At

                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">

                        Actions

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->roles as $role)

                <tr class="border-b last:border-b-0">

                    <td class="px-6 py-4">

                        {{ $role->id }}

                    </td>
                    <td class="px-6 py-4">

                        <a
                            href="{{ route('roles.show', $role->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $role->name }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $role->created_at->format('Y-m-d H:i:s') }}

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $role->updated_at->format('Y-m-d H:i:s') }}

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('roles.show', $role->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>

                            <a
                                href="{{ route('roles.permissions', $role->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">

                                Permissions

                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="4"
                        class="px-6 py-12 text-center text-slate-500">

                        No roles found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $this->roles->links() }}

    </div>

</div>