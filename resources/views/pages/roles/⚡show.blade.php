<?php

use App\Common\Exceptions\HandlesLivewireExceptions;
use App\Domains\Authorization\UseCases\ShowRoleUseCase\ShowRoleUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use HandlesLivewireExceptions;

    public int $id;

    protected ShowRoleUseCase $showRoleUseCase;

    public function boot(ShowRoleUseCase $showRoleUseCase): void
    {
        $this->showRoleUseCase = $showRoleUseCase;
    }

    public function mount(int $id): void
    {
        $this->id = $id;
    }

    #[Computed]
    public function role()
    {
        return $this->showRoleUseCase->execute($this->id);
    }
};
?>

<div class="max-w-5xl">

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Role Details

            </h1>

            <p class="mt-2 text-slate-500">

                View role information.

            </p>

        </div>

        <a
            href="{{ route('roles.list') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-8 py-8">

            <h2 class="text-2xl font-bold text-slate-800">

                {{ $this->role->name }}

            </h2>

        </div>

        <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Created At

                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    {{ $this->role->created_at->format('Y-m-d H:i:s') }}

                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Updated At

                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    {{ $this->role->updated_at->format('Y-m-d H:i:s') }}

                </p>

            </div>

        </div>

    </div>

</div>