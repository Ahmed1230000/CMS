<?php

use App\Domains\Hr\Entities\Hr\HrEntity;
use App\Domains\Hr\UseCases\ShowHrUseCase\ShowHrUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowHrUseCase $showHrUseCase;

    public int $hr_id;

    public function boot(
        ShowHrUseCase $showHrUseCase
    ): void {
        $this->showHrUseCase = $showHrUseCase;
    }

    public function mount(int $id): void
    {
        $this->hr_id = $id;
    }

    #[Computed]
    public function hr()
    {
        return $this->showHrUseCase->execute(
            $this->hr_id
        );
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                HR Details
            </h1>

            <p class="mt-2 text-slate-500">
                View HR employee information.
            </p>

        </div>

        <a
            href="{{ route('hrs.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>


    {{-- HR Card --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-6">

            <div>

                <p class="text-sm font-medium text-slate-500">
                    HR Employee
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    {{ $this->hr->name }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $this->hr->job_title }}
                </p>

            </div>

            @if ($this->hr->is_active)

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

            {{-- ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    ID
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->hr->id }}
                </p>

            </div>


            {{-- Employee Number --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Employee Number
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->hr->employee_number }}
                </p>

            </div>


            {{-- Phone --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Phone
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->phone }}
                </p>

            </div>


            {{-- Personal Email --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Personal Email
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->email }}
                </p>

            </div>


            {{-- Gender --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Gender
                </p>

                <p class="mt-2 text-slate-700">
                    {{ ucfirst($this->hr->gender) }}
                </p>

            </div>


            {{-- Date Of Birth --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Date Of Birth
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->date_of_birth->format('Y-m-d') }}
                </p>

            </div>


            {{-- National ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    National ID
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->national_id }}
                </p>

            </div>


            {{-- Hire Date --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Hire Date
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->hire_date->format('Y-m-d') }}
                </p>

            </div>


            {{-- Job Title --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Job Title
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->job_title }}
                </p>

            </div>


            {{-- User ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    User ID
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->hr->user_id }}
                </p>

            </div>


            {{-- Created By --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created By
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->hr->creator_name }}
                </p>

            </div>


            {{-- Address --}}
            <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">

                <p class="text-sm font-medium text-slate-500">
                    Address
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->address ?: 'No address provided.' }}
                </p>

            </div>


            {{-- Created At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->created_at->format('Y-m-d H:i:s') }}
                </p>

            </div>


            {{-- Updated At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Updated At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->hr->updated_at->format('Y-m-d H:i:s') }}
                </p>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('hrs.show',$this->hr->id) }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                Back

            </a>

            <a
                href="{{ route('hrs.update', $this->hr->id) }}"
                wire:navigate
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                Update

            </a>

        </div>

    </div>

</div>