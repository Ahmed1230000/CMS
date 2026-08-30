<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Patient\DTOs\Patient\PatientDTO;
use App\Domains\Patient\UseCases\Patient\CreatePatientUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected CreatePatientUseCase $createPatientUseCase;

    public string $patient_number = '';
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $gender = '';
    public string $date_of_birth = '';
    public string $national_id = '';
    public string $address = '';
    public bool $is_active = true;

    public function boot(
        CreatePatientUseCase $createPatientUseCase
    ): void {
        $this->createPatientUseCase = $createPatientUseCase;
    }

    protected function rules(): array
    {
        return [
            'patient_number' => [
                'required',
                'string',
                'max:100',
                'unique:patients,patient_number',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
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
                'unique:patients,national_id',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'boolean',
            ],
        ];
    }

    public function create()
    {
        $validation = $this->validate($this->rules());

        try {
            $dto = PatientDTO::fromArray($validation);

            $this->createPatientUseCase->execute($dto);

            session()->flash(
                'success',
                'Patient created successfully.'
            );

            return redirect()->route('patients.index');
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
                Create Patient
            </h1>

            <p class="mt-2 text-slate-500">
                Register a new patient in the hospital system.
            </p>

        </div>

        <a
            href="{{ route('patients.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>


    <form wire:submit="create">

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-200 px-8 py-6">

                <h2 class="text-lg font-semibold text-slate-800">
                    Patient Information
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Enter the patient's personal information.
                </p>

            </div>


            {{-- Fields --}}
            <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

                {{-- Patient Number --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Patient Number
                    </label>

                    <input
                        type="text"
                        wire:model.live="patient_number"
                        placeholder="e.g. PAT-001"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                    @error('patient_number')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- Name --}}
                <div>

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


                {{-- Email --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Email
                    </label>

                    <input
                        type="email"
                        wire:model.live="email"
                        placeholder="e.g. patient@gmail.com"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                    @error('email')
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


                {{-- Address --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Address
                    </label>

                    <input
                        type="text"
                        wire:model.live="address"
                        placeholder="Patient address"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

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
                                Active Patient
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Allow this patient to remain active in the system.
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
                    href="{{ route('patients.index') }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove>
                        Create Patient
                    </span>

                    <span wire:loading>
                        Creating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>