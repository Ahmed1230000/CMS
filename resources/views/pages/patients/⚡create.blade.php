<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Patient\DTOs\Patient\PatientDTO;
use App\Domains\Patient\UseCases\Patient\CreatePatientUseCase;
use App\Domains\Patient\UseCases\AddMedicalDocumentUseCase\AddMedicalDocumentUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;
    use WithFileUploads;

    protected CreatePatientUseCase $createPatientUseCase;

    protected AddMedicalDocumentUseCase $addMedicalDocumentUseCase;

    public string $patient_number = '';

    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $gender = '';

    public string $date_of_birth = '';

    public string $national_id = '';

    public string $address = '';

    public bool $is_active = true;

    public array $documents = [];

    public function boot(
        CreatePatientUseCase $createPatientUseCase,
        AddMedicalDocumentUseCase $addMedicalDocumentUseCase
    ): void {
        $this->createPatientUseCase = $createPatientUseCase;

        $this->addMedicalDocumentUseCase = $addMedicalDocumentUseCase;
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

            'documents' => [
                'nullable',
                'array',
            ],

            'documents.*' => [
                'file',
                'max:10240',
                'mimes:pdf,jpg,jpeg,png',
            ],
        ];
    }

    public function create()
    {
        $validation = $this->validate(
            $this->rules()
        );

        try {
            $patient = $this->createPatientUseCase->execute(
                PatientDTO::fromArray($validation)
            );


            foreach ($this->documents as $document) {
                $this->addMedicalDocumentUseCase->execute(
                    patientId: $patient->id,
                    uploadedFile: $document,
                    creatorId: auth()->id(),
                );
            }
            session()->flash(
                'success',
                'Patient created successfully.'
            );

            return redirect()->route(
                'patients.index'
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
            <div class="grid grid-cols-1 gap-6 p-8">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

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

                </div>


                {{-- Active --}}
                <div>

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


                {{-- Medical Documents --}}
                <div>

                    <div class="rounded-xl border border-slate-200 p-5">

                        <div class="mb-4">

                            <p class="font-medium text-slate-800">
                                Medical Documents
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Optional. You can upload medical documents for this patient.
                            </p>

                        </div>

                        <input
                            type="file"
                            wire:model="documents"
                            multiple
                            class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">


                        <div wire:loading wire:target="documents" class="mt-3 text-sm text-blue-600">
                            Uploading files...
                        </div>

                        @error('documents')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                        @error('documents.*')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror


                        @if ($documents)

                        <div class="mt-4 space-y-2">

                            @foreach ($documents as $document)

                            <div class="flex items-center justify-between rounded-lg bg-slate-50 px-4 py-3">

                                <span class="text-sm text-slate-700">
                                    {{ $document->getClientOriginalName() }}
                                </span>

                                <span class="text-xs text-slate-500">
                                    {{ number_format($document->getSize() / 1024, 1) }} KB
                                </span>

                            </div>

                            @endforeach

                        </div>

                        @endif

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
                    wire:target="create"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove wire:target="create">
                        Create Patient
                    </span>

                    <span wire:loading wire:target="create">
                        Creating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>