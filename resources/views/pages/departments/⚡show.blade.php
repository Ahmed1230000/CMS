<?php

use App\Domains\Department\Entities\Department\DepartmentEntity;
use App\Domains\Department\UseCases\ShowDepartmentUseCase\ShowDepartmentUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowDepartmentUseCase $showDepartmentUseCase;

    public int $department_id;

    #[Url]
    public string $include = '';

    public function boot(
        ShowDepartmentUseCase $showDepartmentUseCase
    ): void {
        $this->showDepartmentUseCase = $showDepartmentUseCase;
    }

    public function mount(int $id): void
    {
        $this->department_id = $id;
    }

    public function loadRelation(): void
    {
        $include = trim($this->include);

        if ($include === '') {
            $this->redirectRoute(
                'departments.show',
                [
                    'id' => $this->department_id,
                ],
                navigate: true
            );

            return;
        }

        $this->redirectRoute(
            'departments.show',
            [
                'id' => $this->department_id,
                'include' => $include,
            ],
            navigate: true
        );
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

    {{-- Page Header --}}
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


    {{-- Include Relation --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="flex-1">

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Include Relation
                </label>

                <input
                    type="text"
                    wire:model="include"
                    placeholder="e.g. creator"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

            </div>

            <button
                type="button"
                wire:click="loadRelation"
                wire:loading.attr="disabled"
                class="mt-7 rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                <span wire:loading.remove>
                    Load
                </span>

                <span wire:loading>
                    Loading...
                </span>

            </button>

        </div>

        <p class="mt-2 text-xs text-slate-500">
            Example: creator
        </p>

    </div>


    {{-- Department Card --}}
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
        <div class="grid grid-cols-1 gap-6 p-8">


            {{-- Basic Information --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- ID --}}
                <div class="rounded-xl border border-slate-200 p-5">

                    <p class="text-sm font-medium text-slate-500">
                        ID
                    </p>

                    <p class="mt-2 text-lg font-semibold text-slate-800">
                        #{{ $this->department->id }}
                    </p>

                </div>


                {{-- Code --}}
                <div class="rounded-xl border border-slate-200 p-5">

                    <p class="text-sm font-medium text-slate-500">
                        Code
                    </p>

                    <p class="mt-2 text-lg font-semibold text-slate-800">
                        {{ $this->department->code }}
                    </p>

                </div>


                {{-- Created By --}}
                <div class="rounded-xl border border-slate-200 p-5">

                    <p class="text-sm font-medium text-slate-500">
                        Created By
                    </p>

                    <p class="mt-2 text-lg font-semibold text-slate-800">
                        #{{ $this->department->created_by }}
                    </p>

                </div>


                {{-- Created At --}}
                <div class="rounded-xl border border-slate-200 p-5">

                    <p class="text-sm font-medium text-slate-500">
                        Created At
                    </p>

                    <p class="mt-2 text-slate-700">
                        {{ $this->department->created_at->format('Y-m-d H:i:s') }}
                    </p>

                </div>


                {{-- Updated At --}}
                <div class="rounded-xl border border-slate-200 p-5">

                    <p class="text-sm font-medium text-slate-500">
                        Updated At
                    </p>

                    <p class="mt-2 text-slate-700">
                        {{ $this->department->updated_at->format('Y-m-d H:i:s') }}
                    </p>

                </div>

            </div>


            {{-- Description --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Description
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->department->description ?: 'No description provided.' }}
                </p>

            </div>


            {{-- Creator Relation --}}
            @if ($this->department->creator)

            <div class="rounded-xl border border-blue-200 bg-blue-50 p-6">

                <div class="mb-4">

                    <p class="text-sm font-medium text-blue-600">
                        Included Relation
                    </p>

                    <h3 class="mt-1 text-lg font-semibold text-slate-800">
                        Creator Information
                    </h3>

                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div>

                        <p class="text-sm text-slate-500">
                            Name
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $this->department->creator->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-slate-500">
                            Email
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $this->department->creator->email->value() }}
                        </p>

                    </div>

                </div>

            </div>

            @endif

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