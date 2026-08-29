<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Employee\DTOs\Employee\EmployeeDTO;
use App\Domains\Employee\UseCases\Employee\CreateEmployeeUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected CreateEmployeeUseCase $createEmployeeUseCase;

    // Hospital account
    public string $name = '';

    public string $email = '';

    public string $password = '';

    // Employee profile
    public string $employee_number = '';

    public string $phone = '';

    public string $personal_email = '';

    public string $gender = '';

    public string $date_of_birth = '';

    public string $national_id = '';

    public string $address = '';

    public string $hire_date = '';

    public string $job_title = '';

    public bool $is_active = true;

    public function boot(
        CreateEmployeeUseCase $createEmployeeUseCase
    ): void {
        $this->createEmployeeUseCase = $createEmployeeUseCase;
    }

    protected function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],

            'employee_number' => [
                'required',
                'string',
                'max:100',
                'unique:employees,employee_number',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'personal_email' => [
                'required',
                'email',
                'max:255',
            ],

            'gender' => [
                'required',
                'string',
                'max:20',
            ],

            'date_of_birth' => [
                'required',
                'date',
            ],

            'national_id' => [
                'required',
                'string',
                'max:50',
                'unique:employees,national_id',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'hire_date' => [
                'required',
                'date',
            ],

            'job_title' => [
                'required',
                'string',
                'max:255',
            ],

            'is_active' => [
                'boolean',
            ],
        ];
    }

    public function create()
    {
        $data = [
            'name'            => $this->name,
            'email'           => $this->email,
            'password'        => $this->password,

            'employee_number' => $this->employee_number,
            'phone'           => $this->phone,
            'personal_email'  => $this->personal_email,
            'gender'          => $this->gender,
            'date_of_birth'   => $this->date_of_birth,
            'national_id'     => $this->national_id,
            'address'         => $this->address,
            'hire_date'       => $this->hire_date,
            'job_title'       => $this->job_title,
            'is_active'       => $this->is_active,
        ];

        $validation = $this->flashValidationMessage(
            $data,
            $this->rules()
        );

        if (!$validation) {
            return;
        }

        try {
            $dto = EmployeeDTO::fromArray($validation);

            $this->createEmployeeUseCase->execute($dto);

            session()->flash(
                'success',
                'Employee created successfully.'
            );

            return $this->redirectRoute(
                'employees.index'
            );
        } catch (\Throwable $exception) {
            $this->handleException($exception);
        }
    }
};
?>

<div class="max-w-5xl">

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Create Employee
            </h1>

            <p class="mt-2 text-slate-500">
                Create a hospital employee account and profile.
            </p>

        </div>

        <a
            href="{{ route('employees.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>


    <form wire:submit="create">

        <div class="space-y-6">


            {{-- Hospital Account --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Hospital Account
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        These credentials will be used to access the hospital system.
                    </p>

                </div>

                <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

                    {{-- Name --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Full Name
                        </label>

                        <input
                            type="text"
                            wire:model.live="name"
                            placeholder="e.g. Ahmed Mahmoud"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Hospital Email --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Hospital Email
                        </label>

                        <input
                            type="email"
                            wire:model.live="email"
                            placeholder="e.g. ahmed@hospital.com"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        <p class="mt-1 text-xs text-slate-500">
                            Used to log in to the hospital system.
                        </p>

                        @error('email')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Password
                        </label>

                        <input
                            type="password"
                            wire:model.live="password"
                            placeholder="Minimum 8 characters"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('password')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Employee Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Employee Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Enter the employee's personal and employment information.
                    </p>

                </div>

                <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">


                    {{-- Employee Number --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Employee Number
                        </label>

                        <input
                            type="text"
                            wire:model.live="employee_number"
                            placeholder="e.g. EMP-001"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('employee_number')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Phone
                        </label>

                        <input
                            type="text"
                            wire:model.live="phone"
                            placeholder="e.g. 01012345678"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('phone')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Personal Email --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Personal Email
                        </label>

                        <input
                            type="email"
                            wire:model.live="personal_email"
                            placeholder="e.g. ahmed@gmail.com"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        <p class="mt-1 text-xs text-slate-500">
                            Personal contact email, not the hospital login email.
                        </p>

                        @error('personal_email')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Gender --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Gender
                        </label>

                        <select
                            wire:model.live="gender"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                            <option value="">
                                Select gender
                            </option>

                            <option value="male">
                                Male
                            </option>

                            <option value="female">
                                Female
                            </option>

                        </select>

                        @error('gender')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Date of Birth --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Date of Birth
                        </label>

                        <input
                            type="date"
                            wire:model.live="date_of_birth"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('date_of_birth')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- National ID --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            National ID
                        </label>

                        <input
                            type="text"
                            wire:model.live="national_id"
                            placeholder="National ID"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('national_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Hire Date --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Hire Date
                        </label>

                        <input
                            type="date"
                            wire:model.live="hire_date"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('hire_date')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Job Title --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Job Title
                        </label>

                        <input
                            type="text"
                            wire:model.live="job_title"
                            placeholder="e.g. Receptionist"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('job_title')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Address --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Address
                        </label>

                        <textarea
                            wire:model.live="address"
                            rows="4"
                            placeholder="Enter address..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                        @error('address')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Active --}}
                    <div class="md:col-span-2">

                        <div class="flex items-center justify-between rounded-xl border border-slate-200 p-4">

                            <div>

                                <p class="font-medium text-slate-800">
                                    Active Employee
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Allow this employee to be active in the system.
                                </p>

                            </div>

                            <input
                                type="checkbox"
                                wire:model="is_active"
                                class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                        </div>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('employees.index') }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove>
                        Create Employee
                    </span>

                    <span wire:loading>
                        Creating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>