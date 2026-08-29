<?php

use App\Domains\Employee\Entities\Employee\EmployeeEntity;
use App\Domains\Employee\UseCases\ShowEmplyeesUseCase\ShowEmplyeesUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowEmplyeesUseCase $showEmplyeesUseCase;

    public int $employee_id;

    public function boot(
        ShowEmplyeesUseCase $showEmplyeesUseCase
    ): void {
        $this->showEmplyeesUseCase = $showEmplyeesUseCase;
    }

    public function mount(string $id): void
    {
        $this->employee_id = (int) $id;
    }

    #[Computed]
    public function employee(): EmployeeEntity
    {
        return $this->showEmplyeesUseCase->execute(
            $this->employee_id
        );
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Employee Details
            </h1>

            <p class="mt-2 text-slate-500">
                View employee information.
            </p>

        </div>

        <a
            href="{{ route('employees.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>


    {{-- Employee Card --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-6">

            <div>

                <p class="text-sm font-medium text-slate-500">
                    Employee
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    {{ $this->employee->name }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $this->employee->job_title }}
                </p>

            </div>

            @if ($this->employee->is_active)

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
                    #{{ $this->employee->id }}
                </p>

            </div>


            {{-- Employee Number --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Employee Number
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->employee->employee_number }}
                </p>

            </div>


            {{-- Phone --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Phone
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->phone }}
                </p>

            </div>


            {{-- Personal Email --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Personal Email
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->email }}
                </p>

            </div>


            {{-- Gender --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Gender
                </p>

                <p class="mt-2 text-slate-700">
                    {{ ucfirst($this->employee->gender) }}
                </p>

            </div>


            {{-- Date Of Birth --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Date Of Birth
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->date_of_birth->format('Y-m-d') }}
                </p>

            </div>


            {{-- National ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    National ID
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->national_id }}
                </p>

            </div>


            {{-- Hire Date --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Hire Date
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->hire_date->format('Y-m-d') }}
                </p>

            </div>


            {{-- Job Title --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Job Title
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->job_title }}
                </p>

            </div>


            {{-- User ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    User ID
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->employee->user_id }}
                </p>

            </div>


            {{-- Created By --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created By
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->employee->created_by }}
                </p>

            </div>


            {{-- Address --}}
            <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">

                <p class="text-sm font-medium text-slate-500">
                    Address
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->address ?: 'No address provided.' }}
                </p>

            </div>


            {{-- Created At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->created_at->format('Y-m-d H:i:s') }}
                </p>

            </div>


            {{-- Updated At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Updated At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->employee->updated_at->format('Y-m-d H:i:s') }}
                </p>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('employees.index') }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                Back

            </a>

            <a
                href="{{ route('employees.update', ['id' => $this->employee->id]) }}"
                wire:navigate
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                Update

            </a>

        </div>

    </div>

</div>