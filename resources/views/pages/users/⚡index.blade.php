<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Domains\User\UseCases\ListUsersUseCase\ListUsersUseCase;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

new #[Layout('layouts.dashboard')] class extends Component
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected ListUsersUseCase $listUsersUseCase;

    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    public function boot(ListUsersUseCase $listUsersUseCase): void
    {
        $this->listUsersUseCase = $listUsersUseCase;
    }

    /*
    |--------------------------------------------------------------------------
    | users
    |--------------------------------------------------------------------------
    */
    #[Computed] #[On('user-deleted')]
    public function users()
    {
        return  $this->listUsersUseCase->execute();
    }
};

?>

<div>

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Users

            </h1>

            <p class="mt-2 text-slate-500">

                Manage all system users.

            </p>

        </div>

        <a
            href="{{ route('users.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create User

        </a>

    </div>

    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Name
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Email
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

                @foreach ($this->users as $user)

                <tr class="border-b last:border-b-0">

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('users.show', $user->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $user->name }}

                        </a>

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $user->email }}

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $user->created_at->format('Y-m-d H:i:s') }}

                    </td>

                    <td class="px-6 py-4 text-slate-600">

                        {{ $user->updated_at->format('Y-m-d H:i:s') }}

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('users.show', $user->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>

                            <a
                                href="{{ route('users.roles', $user->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">

                                Roles
                            </a>
                            <a
                                href="{{ route('users.permissions', $user->id) }}"
                                wire:navigate
                                class="rounded-lg bg-purple-100 px-3 py-2 text-sm font-medium text-purple-700 transition hover:bg-purple-200">

                                Permissions

                            </a>

                            <livewire:layouts.delete
                                :user-id="$user->id"
                                :key="$user->id" />

                        </div>

                    </td>

                </tr>

                @endforeach

                {{ $this->users->links() }}

            </tbody>

        </table>

    </div>

</div>