<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use App\Domains\User\UseCases\ListUsersUseCase\ListUsersUseCase;
use Livewire\Attributes\Title;

new #[Layout('layouts.dashboard')] #[Title('User')] class extends Component
{
    protected ListUsersUseCase $listUsersUseCase;

    public function boot(ListUsersUseCase $listUsersUseCase): void
    {
        $this->listUsersUseCase = $listUsersUseCase;
    }

    #[Computed]
    #[On('user-deleted')]
    public function users()
    {
        return $this->listUsersUseCase->execute();
    }
};
?>

<div class="min-h-full bg-slate-50">

    {{-- Page Header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-400">
                <span>Authentication</span>
                <span>/</span>
                <span class="text-slate-600">Users</span>
            </div>

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Users
            </h1>

            <p class="mt-2 text-slate-500">
                Manage all system users.
            </p>
        </div>

        <a
            href="{{ route('users.create') }}"
            wire:navigate
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 hover:shadow-md">
            <svg
                class="h-5 w-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>

            Create User
        </a>

    </div>


    {{-- Statistics --}}
    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total Users --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50">
                    <svg
                        class="h-6 w-6 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H6a4 4 0 01-4-4v-1a4 4 0 014-4h7a4 4 0 014 4v1a4 4 0 01-4 4zm0-10a4 4 0 100-8 4 4 0 000 8zm6 2a3 3 0 100-6 3 3 0 000 6z" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Users
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        {{ $this->users->total() }}
                    </p>
                </div>

            </div>
        </div>


        {{-- Current Page --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50">
                    <svg
                        class="h-6 w-6 text-emerald-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Showing
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        {{ $this->users->count() }}
                    </p>
                </div>

            </div>
        </div>


        {{-- Current Page Number --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50">
                    <svg
                        class="h-6 w-6 text-violet-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Current Page
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        {{ $this->users->currentPage() }}
                    </p>
                </div>

            </div>
        </div>


        {{-- Last Page --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50">
                    <svg
                        class="h-6 w-6 text-orange-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Pages
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-900">
                        {{ $this->users->lastPage() }}
                    </p>
                </div>

            </div>
        </div>

    </div>


    {{-- Users Table --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="border-b border-slate-200 px-6 py-5">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        System Users
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        All registered users in the system.
                    </p>
                </div>

                <div class="rounded-lg bg-slate-50 px-4 py-2 text-sm text-slate-600">
                    Showing
                    <span class="font-semibold text-slate-900">
                        {{ $this->users->firstItem() ?? 0 }}
                    </span>

                    to

                    <span class="font-semibold text-slate-900">
                        {{ $this->users->lastItem() ?? 0 }}
                    </span>

                    of

                    <span class="font-semibold text-slate-900">
                        {{ $this->users->total() }}
                    </span>
                </div>

            </div>

        </div>


        {{-- Responsive Table --}}
        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="border-b border-slate-200 bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            User
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Created At
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Updated At
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($this->users as $user)

                    <tr class="group transition hover:bg-slate-50">

                        {{-- User --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>

                                <div>
                                    <a
                                        href="{{ route('users.show', $user->id) }}"
                                        wire:navigate
                                        class="font-semibold text-slate-800 transition hover:text-blue-600">
                                        {{ $user->name }}
                                    </a>

                                    <p class="mt-0.5 text-xs text-slate-400">
                                        User #{{ $user->id }}
                                    </p>
                                </div>

                            </div>

                        </td>


                        {{-- Email --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <span class="text-sm text-slate-600">
                                {{ $user->email }}
                            </span>

                        </td>


                        {{-- Created --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <div class="text-sm text-slate-700">
                                {{ $user->created_at->format('Y-m-d') }}
                            </div>

                            <div class="mt-1 text-xs text-slate-400">
                                {{ $user->created_at->format('H:i:s') }}
                            </div>

                        </td>


                        {{-- Updated --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <div class="text-sm text-slate-700">
                                {{ $user->updated_at->format('Y-m-d') }}
                            </div>

                            <div class="mt-1 text-xs text-slate-400">
                                {{ $user->updated_at->format('H:i:s') }}
                            </div>

                        </td>


                        {{-- Actions --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <div class="flex items-center justify-end gap-2">

                                {{-- View --}}
                                <a
                                    href="{{ route('users.show', $user->id) }}"
                                    wire:navigate
                                    title="View User"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200 hover:text-slate-900">
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>


                                {{-- Roles --}}
                                <a
                                    href="{{ route('users.roles', $user->id) }}"
                                    wire:navigate
                                    title="Manage Roles"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600 transition hover:bg-blue-100">
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />

                                        <circle
                                            cx="9"
                                            cy="7"
                                            r="4"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 8v6m3-3h-6" />
                                    </svg>
                                </a>


                                {{-- Permissions --}}
                                <a
                                    href="{{ route('users.permissions', $user->id) }}"
                                    wire:navigate
                                    title="Manage Permissions"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 text-violet-600 transition hover:bg-violet-100">
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 15a3 3 0 100-6 3 3 0 000 6z" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06A1.65 1.65 0 004.6 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06A1.65 1.65 0 009 4.6a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06A1.65 1.65 0 0019.4 9c.14.58.63 1 1.22 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
                                    </svg>
                                </a>


                                {{-- Delete --}}
                                <div>
                                    <livewire:layouts.delete
                                        :user-id="$user->id"
                                        :key="'delete-user-'.$user->id" />
                                </div>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                    <svg
                                        class="h-8 w-8 text-slate-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                                    </svg>
                                </div>

                                <h3 class="text-lg font-semibold text-slate-800">
                                    No users found
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    There are currently no users to display.
                                </p>

                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($this->users->hasPages())

        <div class="border-t border-slate-200 px-6 py-4">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-slate-500">
                    Showing
                    <span class="font-semibold text-slate-700">
                        {{ $this->users->firstItem() ?? 0 }}
                    </span>

                    to

                    <span class="font-semibold text-slate-700">
                        {{ $this->users->lastItem() ?? 0 }}
                    </span>

                    of

                    <span class="font-semibold text-slate-700">
                        {{ $this->users->total() }}
                    </span>
                    results
                </p>

                <div>
                    {{ $this->users->links() }}
                </div>

            </div>

        </div>

        @endif

    </div>

</div>