<?php

use App\Domains\Authorization\UseCases\ShowPermissionUseCase\ShowPermissionUseCase;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    public int $id;

    protected ShowPermissionUseCase $showPermissionUseCase;

    public function boot(ShowPermissionUseCase $showPermissionUseCase): void
    {
        $this->showPermissionUseCase = $showPermissionUseCase;
    }

    public function mount(int $id): void
    {
        $this->id = $id;
    }

    #[Computed]
    public function permission()
    {
        return $this->showPermissionUseCase->execute($this->id);
    }
};
?>

<div class="max-w-5xl">

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Permission Details

            </h1>

            <p class="mt-2 text-slate-500">

                View permission information.

            </p>

        </div>

        <a
            href="{{ route('permissions.list') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-8 py-8">

            <p class="mb-2 text-sm font-medium text-slate-500">

                Permission Name

            </p>

            <h2 class="text-2xl font-bold text-slate-800">

                {{ $this->permission->name }}

            </h2>

        </div>

        <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-3">

            <div>

                <p class="text-sm font-medium text-slate-500">

                    ID

                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    {{ $this->permission->id }}

                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Created At

                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    {{ $this->permission->created_at->format('Y-m-d H:i:s') }}

                </p>

            </div>

            <div>

                <p class="text-sm font-medium text-slate-500">

                    Updated At

                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    {{ $this->permission->updated_at->format('Y-m-d H:i:s') }}

                </p>

            </div>

        </div>

    </div>

</div>