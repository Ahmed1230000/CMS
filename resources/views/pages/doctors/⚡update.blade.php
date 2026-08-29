<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Department\UseCases\ListDepartmentsUseCase\ListDepartmentsUseCase;
use App\Domains\Doctor\DTOs\Doctor\DoctorDTO;
use App\Domains\Doctor\Entities\Doctor\DoctorEntity;
use App\Domains\Doctor\UseCases\Doctor\UpdateDoctorUseCase;
use App\Domains\Doctor\UseCases\ShowDoctorUseCase\ShowDoctorUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected ShowDoctorUseCase $showDoctorUseCase;

    protected UpdateDoctorUseCase $updateDoctorUseCase;

    protected ListDepartmentsUseCase $listDepartmentsUseCase;

    public int $doctor_id;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public int|string $department_id = '';

    public string $license_number = '';

    public string $specialization = '';

    public string $phone = '';

    public string $personal_email = '';

    public string $bio = '';

    public bool $is_active = true;

    public function boot(
        ShowDoctorUseCase $showDoctorUseCase,
        UpdateDoctorUseCase $updateDoctorUseCase,
        ListDepartmentsUseCase $listDepartmentsUseCase
    ): void {
        $this->showDoctorUseCase = $showDoctorUseCase;
        $this->updateDoctorUseCase = $updateDoctorUseCase;
        $this->listDepartmentsUseCase = $listDepartmentsUseCase;
    }

    public function mount(int $id): void
    {
        $this->doctor_id = $id;

        $doctor = $this->showDoctorUseCase->execute($id);

        /*
        |--------------------------------------------------------------------------
        | Doctor profile
        |--------------------------------------------------------------------------
        */

        $this->department_id = $doctor->department_id;
        $this->license_number = $doctor->license_number;
        $this->specialization = $doctor->specialization;
        $this->phone = $doctor->phone;
        $this->personal_email = $doctor->email;
        $this->bio = $doctor->bio ?? '';
        $this->is_active = $doctor->is_active;

        /*
        |--------------------------------------------------------------------------
        | User data
        |--------------------------------------------------------------------------
        |
        | We are not changing User data here yet.
        | These properties only exist because DoctorDTO currently
        | contains User account fields.
        |
        */

        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    protected function rules(): array
    {
        return [
            'department_id' => [
                'required',
                'integer',
                'exists:departments,id',
            ],

            'license_number' => [
                'required',
                'string',
                'max:100',
                'unique:doctors,license_number,' . $this->doctor_id,
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
        ];
    }

    public function update()
    {
        $data = [
            'department_id' => $this->department_id,
            'license_number' => $this->license_number,
            'specialization' => $this->specialization,
            'phone' => $this->phone,
            'personal_email' => $this->personal_email,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
        ];

        $validation = $this->flashValidationMessage(
            $data,
            $this->rules()
        );

        if (!$validation) {
            return;
        }

        try {
            /*
            |--------------------------------------------------------------------------
            | Get current Entity
            |--------------------------------------------------------------------------
            */

            $doctorEntity = $this->showDoctorUseCase->execute(
                $this->doctor_id
            );

            /*
            |--------------------------------------------------------------------------
            | Build DTO
            |--------------------------------------------------------------------------
            |
            | Current DoctorDTO requires user fields, so we keep
            | them out of the editable form and pass temporary values.
            |
            */

            $dto = DoctorDTO::fromArray([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,

                'department_id' => $validation['department_id'],
                'license_number' => $validation['license_number'],
                'specialization' => $validation['specialization'],
                'phone' => $validation['phone'],
                'personal_email' => $validation['personal_email'],
                'bio' => $validation['bio'] ?? null,
                'is_active' => $validation['is_active'] ?? true,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update
            |--------------------------------------------------------------------------
            */

            $this->updateDoctorUseCase->execute(
                $dto,
                $doctorEntity
            );

            session()->flash(
                'success',
                'Doctor updated successfully.'
            );

            return $this->redirectRoute(
                'doctors.show',
                ['id' => $this->doctor_id]
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
                Edit Doctor
            </h1>

            <p class="mt-2 text-slate-500">
                Update doctor professional information.
            </p>

        </div>

        <a
            href="{{ route('doctors.show', ['id' => $doctor_id]) }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>


    <form wire:submit="update">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">


            {{-- Header --}}
            <div class="border-b border-slate-200 px-8 py-6">

                <p class="text-sm font-medium text-slate-500">
                    Doctor #{{ $doctor_id }}
                </p>

                <h2 class="mt-1 text-xl font-bold text-slate-800">
                    Doctor Information
                </h2>

            </div>


            {{-- Information --}}
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

                        @if ($department->is_active || $department->id == $department_id)

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
                                Allow this doctor to remain active in the system.
                            </p>

                        </div>

                        <input
                            type="checkbox"
                            wire:model="is_active"
                            class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('doctors.show', ['id' => $doctor_id]) }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove>
                        Update Doctor
                    </span>

                    <span wire:loading>
                        Updating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>