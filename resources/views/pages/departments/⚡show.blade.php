<?php

use App\Domains\Department\Entities\Department\DepartmentEntity;
use App\Domains\Department\UseCases\ShowDepartmentUseCase\ShowDepartmentUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowDepartmentUseCase $showDepartmentUseCase;

    public int $department_id;

    public function boot(
        ShowDepartmentUseCase $showDepartmentUseCase
    ): void {
        $this->showDepartmentUseCase = $showDepartmentUseCase;
    }

    public function mount(int $id): void
    {
        $this->department_id = $id;
    }

    #[Computed]
    public function department(): DepartmentEntity
    {
        return $this->showDepartmentUseCase->execute(
            $this->department_id
        );
    }
};
?>

<div>

    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Department Details
            </h1>

            <p class="mt-2 text-slate-500">
                View department information.
            </p>

        </div>

        <a
            href="{{ route('departments.list') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}

        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-6">

            <div>

                <p class="text-sm font-medium text-slate-500">
                    Department
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    {{ $this->department->name }}
                </h2>

            </div>

            @if ($this->department->is_active)

            <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-medium text-green-700">
                Active
            </span>

            @else

            <span class="rounded-full bg-red-100 px-4 py-2 text-sm font-medium text-red-700">
                Inactive
            </span>

            @endif

        </div>

        {{-- Information --}}

        <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    ID
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->department->id }}
                </p>

            </div>

            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Code
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->department->code }}
                </p>

            </div>

            <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">

                <p class="text-sm font-medium text-slate-500">
                    Description
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->department->description ?: 'No description provided.' }}
                </p>

            </div>

            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created By
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->department->created_by }}
                </p>

            </div>

            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->department->created_at->format('Y-m-d H:i:s') }}
                </p>

            </div>

            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Updated At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->department->updated_at->format('Y-m-d H:i:s') }}
                </p>

            </div>

        </div>

        {{-- Actions --}}

        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('departments.list') }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                Back

            </a>

            

        </div>

    </div>

</div>