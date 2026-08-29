<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Doctor\DTOs\Doctor\DoctorDTO;
use App\Domains\Doctor\UseCases\Doctor\CreateDoctorUseCase;
use App\Domains\Department\UseCases\ListDepartmentsUseCase\ListDepartmentsUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected CreateDoctorUseCase $createDoctorUseCase;

    protected ListDepartmentsUseCase $listDepartmentsUseCase;

    // Hospital account
    public string $name = '';

    public string $email = '';

    public string $password = '';

    // Doctor profile
    public int|string $department_id = '';

    public string $license_number = '';

    public string $specialization = '';

    public string $phone = '';

    public string $personal_email = '';

    public string $bio = '';

    public bool $is_active = true;

    public function boot(
        CreateDoctorUseCase $createDoctorUseCase,
        ListDepartmentsUseCase $listDepartmentsUseCase
    ): void {
        $this->createDoctorUseCase = $createDoctorUseCase;
        $this->listDepartmentsUseCase = $listDepartmentsUseCase;
    }

    public function create()
    {
        $data = [
            'name'            => $this->name,
            'email'           => $this->email,
            'password'        => $this->password,

            'department_id'   => $this->department_id,
            'license_number'  => $this->license_number,
            'specialization'  => $this->specialization,
            'phone'           => $this->phone,
            'personal_email'  => $this->personal_email,
            'bio'             => $this->bio,
            'is_active'       => $this->is_active,
        ];

        $validation = $this->validate([
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

            'department_id' => [
                'required',
                'integer',
                'exists:departments,id',
            ],

            'license_number' => [
                'required',
                'string',
                'max:100',
                'unique:doctors,license_number',
            ],

            'specialization' => [
                'required',
                'string',
                'max:255',
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

            'bio' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'boolean',
            ],
        ]);

        

        try {

            $dto = DoctorDTO::fromArray($validation);

            $this->createDoctorUseCase->execute($dto);

            session()->flash(
                'success',
                'Doctor created successfully.'
            );

            return $this->redirectRoute(
                'doctors.index'
            );
        } catch (\Throwable $exception) {

            $this->handleException($exception);
        }
    }

    public function departments()
    {
        return $this->listDepartmentsUseCase->execute();
    }
};
?>

<div class="max-w-5xl">

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Create Doctor
            </h1>

            <p class="mt-2 text-slate-500">
                Create a hospital doctor account and profile.
            </p>

        </div>

        <a
            href="{{ route('doctors.index') }}"
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


            {{-- Doctor Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Doctor Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Enter the doctor's professional information.
                    </p>

                </div>

                <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">


                    {{-- Department --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Department
                        </label>

                        <select
                            wire:model.live="department_id"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                            <option value="">
                                Select department
                            </option>

                            @foreach ($this->departments() as $department)

                            @if ($department->is_active)

                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>

                            @endif

                            @endforeach

                        </select>

                        @error('department_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- License Number --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            License Number
                        </label>

                        <input
                            type="text"
                            wire:model.live="license_number"
                            placeholder="e.g. DOC-123456"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('license_number')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Specialization --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Specialization
                        </label>

                        <input
                            type="text"
                            wire:model.live="specialization"
                            placeholder="e.g. Cardiology"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('specialization')
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
                            placeholder="e.g. doctor@gmail.com"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('personal_email')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Bio --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Bio
                        </label>

                        <textarea
                            wire:model.live="bio"
                            rows="5"
                            placeholder="Enter a short professional bio..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                        @error('bio')
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
                                    Active Doctor
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Allow this doctor to be active in the system.
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
                    href="{{ route('doctors.index') }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove>
                        Create Doctor
                    </span>

                    <span wire:loading>
                        Creating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>