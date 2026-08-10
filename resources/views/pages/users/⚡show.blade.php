<?php

use App\Domains\User\DTOs\User\ShowUserDTO;
use App\Domains\User\UseCases\ShowUserUseCase\ShowUserUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{

    protected ShowUserUseCase $showUserUseCase;

    public function boot(ShowUserUseCase $showUserUseCase): void
    {
        $this->showUserUseCase = $showUserUseCase;
    }

    public int $id;

    public function mount(int $id): void
    {
        $this->id = $id;
    }
    
    #[Computed]
    public function user()
    {
        return $this->showUserUseCase->execute($this->id);
    }
};
?>

<div class="max-w-5xl">

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                User Profile

            </h1>

            <p class="mt-2 text-slate-500">

                View user account information.

            </p>

        </div>

        <a
            href="{{ route('users.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-8 py-8">

            <div class="flex items-center gap-6">

                <div class="flex h-24 w-24 items-center justify-center rounded-full bg-blue-600 text-3xl font-bold text-white">

                    {{ strtoupper(substr($this->user->name, 0, 1)) }}

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-slate-800">

                        {{ $this->user->name }}

                    </h2>

                    <p class="mt-1 text-slate-500">

                        {{ $this->user->email }}

                    </p>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

            <div>

                <p class="text-sm font-medium text-slate-500">

                    User ID

                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    #{{ $this->user->id }}

                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Status

                </p>

                <span class="mt-1 inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">

                    Active

                </span>

            </div>

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Created At

                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    {{ $this->user->created_at->format('Y-m-d H:i:s') }}

                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Updated At

                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    {{ $this->user->updated_at->format('Y-m-d H:i:s') }}

                </p>

            </div>

        </div>

        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <button
                type="button"
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                Change Password

            </button>

            <button
                type="button"
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                Assign Roles

            </button>

        </div>

    </div>

</div>