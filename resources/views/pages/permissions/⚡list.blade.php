<?php

use App\Domains\Authorization\UseCases\ListPermissionsUseCase\ListPermissionsUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ListPermissionsUseCase $listPermissionsUseCase;

    public function boot(ListPermissionsUseCase $listPermissionsUseCase)
    {
        $this->listPermissionsUseCase = $listPermissionsUseCase;
    }
    #[Computed]
    public function permissions()
    {
        return $this->listPermissionsUseCase->execute();
    }
};
?>

<div>

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Permissions

            </h1>

            <p class="mt-2 text-slate-500">

                Manage all system permissions.

            </p>

        </div>

        <a
            href="{{ route('permissions.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create Permission

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

                @forelse ($this->permissions as $permission)

                <tr class="border-b last:border-b-0">

                    <td class="px-6 py-4">

                        {{ $permission->id }}

                    </td>

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('permissions.show', $permission->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $permission->name }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $permission->created_at->format('Y-m-d H:i:s') }}

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $permission->updated_at->format('Y-m-d H:i:s') }}

                    </td>

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('permissions.show', $permission->id) }}"
                            wire:navigate
                            class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                            View

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="5"
                        class="px-6 py-12 text-center text-slate-500">

                        No permissions found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $this->permissions->links() }}

    </div>

</div>