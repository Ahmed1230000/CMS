<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\Patient\DTOs\Patient\PatientDTO;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;
use App\Domains\Patient\UseCases\GetPatientMedicalDocumentsUseCase\GetPatientMedicalDocumentsUseCase;
use App\Domains\Patient\UseCases\Patient\UpdatePatientUseCase;
use App\Domains\Patient\UseCases\ShowPatientUseCase\ShowPatientUseCase;
use App\Domains\Patient\UseCases\UpdateMedicalDocumentUseCase\UpdateMedicalDocumentUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;
    use WithFileUploads;

    protected UpdatePatientUseCase $updatePatientUseCase;

    protected PatientRepositoryInterface $patientRepositoryInterface;

    protected GetPatientMedicalDocumentsUseCase $getPatientMedicalDocumentsUseCase;

    protected UpdateMedicalDocumentUseCase $updateMedicalDocumentUseCase;

    public int $patient_id;

    public string $patient_number = '';

    public string $name = '';

    public string $phone = '';

    public string $email = '';

    public string $gender = '';

    public string $date_of_birth = '';

    public string $national_id = '';

    public string $address = '';

    public bool $is_active = true;

    /**
     * @var array<int, \Livewire\Features\SupportFileUploads\TemporaryUploadedFile>
     */
    public array $documentFiles = [];

    public function boot(
        UpdatePatientUseCase $updatePatientUseCase,
        PatientRepositoryInterface $patientRepositoryInterface,
        GetPatientMedicalDocumentsUseCase $getPatientMedicalDocumentsUseCase,
        UpdateMedicalDocumentUseCase $updateMedicalDocumentUseCase
    ): void {
        $this->updatePatientUseCase = $updatePatientUseCase;

        $this->patientRepositoryInterface = $patientRepositoryInterface;

        $this->getPatientMedicalDocumentsUseCase = $getPatientMedicalDocumentsUseCase;

        $this->updateMedicalDocumentUseCase = $updateMedicalDocumentUseCase;
    }

    public function mount(string $id): void
    {
        $this->patient_id = (int) $id;

        $patient = $this->patientRepositoryInterface->find(
            $this->patient_id
        );

        $this->patient_number = $patient->patient_number;

        $this->name = $patient->name;

        $this->phone = $patient->phone;

        $this->email = $patient->email ?? '';

        $this->gender = $patient->gender;

        $this->date_of_birth = $patient->date_of_birth->format('Y-m-d');

        $this->national_id = $patient->national_id;

        $this->address = $patient->address ?? '';

        $this->is_active = $patient->is_active;
    }

    protected function rules(): array
    {
        return [
            'patient_number' => [
                'required',
                'string',
                'max:100',
                'unique:patients,patient_number,' . $this->patient_id,
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
                'unique:patients,national_id,' . $this->patient_id,
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

    protected function documentRules(int $mediaId): array
    {
        return [
            "documentFiles.$mediaId" => [
                'required',
                'file',
                'max:10240',
                'mimes:pdf,jpg,jpeg,png',
            ],
        ];
    }

    #[Computed]
    public function medicalDocuments()
    {
        return $this->getPatientMedicalDocumentsUseCase->execute(
            $this->patient_id
        );
    }

    public function update()
    {
        $validation = $this->validate(
            $this->rules()
        );

        try {
            $patientEntity = $this->patientRepositoryInterface->find(
                $this->patient_id
            );

            $dto = PatientDTO::fromArray($validation);

            $this->updatePatientUseCase->execute(
                $dto,
                $patientEntity
            );

            session()->flash(
                'success',
                'Patient updated successfully.'
            );

            return $this->redirectRoute(
                'patients.show',
                ['id' => $this->patient_id]
            );
        } catch (\Throwable $exception) {
            $this->handleException($exception);
        }
    }

    public function updateMedicalDocument(int $mediaId): void
    {
        $this->validate(
            $this->documentRules($mediaId)
        );

        try {
            $uploadedFile = $this->documentFiles[$mediaId];

            $this->updateMedicalDocumentUseCase->execute(
                patientId: $this->patient_id,
                mediaId: $mediaId,
                uploadedFile: $uploadedFile
            );

            unset($this->documentFiles[$mediaId]);

            unset($this->medicalDocuments);

            session()->flash(
                'success',
                'Medical document updated successfully.'
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
                Edit Patient
            </h1>

            <p class="mt-2 text-slate-500">
                Update patient information and medical documents.
            </p>

        </div>

        <a
            href="{{ route('patients.show', ['id' => $patient_id]) }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">
            Cancel
        </a>

    </div>


    <form wire:submit="update">

        <div class="space-y-6">

            {{-- Patient Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <p class="text-sm font-medium text-slate-500">
                        Patient #{{ $patient_id }}
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-slate-800">
                        Patient Information
                    </h2>

                </div>


                <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

                    {{-- Patient Number --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Patient Number
                        </label>

                        <input
                            type="text"
                            wire:model.live="patient_number"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3">

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
                            class="w-full rounded-xl border border-slate-300 px-4 py-3">

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
                            class="w-full rounded-xl border border-slate-300 px-4 py-3">

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
                            class="w-full rounded-xl border border-slate-300 px-4 py-3">

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
                            class="w-full rounded-xl border border-slate-300 px-4 py-3">

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


                    {{-- Date Of Birth --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Date of Birth
                        </label>

                        <input
                            type="date"
                            wire:model.live="date_of_birth"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3">

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
                            class="w-full rounded-xl border border-slate-300 px-4 py-3">

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
                            class="w-full rounded-xl border border-slate-300 px-4 py-3">

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

            </div>


            {{-- Medical Documents --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Medical Documents
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Replace an existing medical document without affecting the others.
                    </p>

                </div>


                <div class="space-y-4 p-8">

                    @forelse ($this->medicalDocuments as $document)

                    <div
                        wire:key="medical-document-{{ $document->id }}"
                        class="rounded-xl border border-slate-200 p-5">

                        {{-- Current Document --}}
                        <div class="flex items-center justify-between">

                            <div class="min-w-0">

                                <p class="truncate font-medium text-slate-800">
                                    {{ $document->file_name }}
                                </p>

                                <div class="mt-1 flex gap-4 text-sm text-slate-500">

                                    <span>
                                        {{ $document->mime_type }}
                                    </span>

                                    <span>
                                        {{ number_format($document->size / 1024, 1) }} KB
                                    </span>

                                </div>

                            </div>


                            <a
                                href="{{ route('patients.documents.view', [
                                        'patient' => $patient_id,
                                        'media' => $document->id,
                                    ]) }}"
                                target="_blank"
                                class="ml-4 rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
                                View
                            </a>

                        </div>


                        {{-- Replace --}}
                        <div class="mt-5">

                            <label class="mb-2 block text-sm font-medium text-slate-700">
                                Replace Document
                            </label>

                            <div class="flex items-end gap-3">

                                <div class="flex-1">

                                    <input
                                        type="file"
                                        wire:model="documentFiles.{{ $document->id }}"
                                        class="block w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">

                                    <div class="mt-2 min-h-5">

                                        <div
                                            wire:loading
                                            wire:target="documentFiles.{{ $document->id }}"
                                            class="text-sm text-blue-600">
                                            Uploading...
                                        </div>

                                    </div>

                                    <div class="mt-2 min-h-5">
                                        @error('documentFiles.' . $document->id)
                                        <p class="text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                </div>


                                <button
                                    type="button"
                                    wire:click="updateMedicalDocument({{ $document->id }})"
                                    wire:loading.attr="disabled"
                                    wire:target="updateMedicalDocument({{ $document->id }})"
                                    class="rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                                    <span
                                        wire:loading.remove
                                        wire:target="updateMedicalDocument({{ $document->id }})">
                                        Update
                                    </span>

                                    <span
                                        wire:loading
                                        wire:target="updateMedicalDocument({{ $document->id }})">
                                        Updating...
                                    </span>

                                </button>

                            </div>

                        </div>

                    </div>

                    @empty

                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-5 py-6 text-center text-sm text-slate-500">
                        No medical documents found.
                    </div>

                    @endforelse

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('patients.show', ['id' => $patient_id]) }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">
                    Cancel
                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="update"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove wire:target="update">
                        Update Patient
                    </span>

                    <span wire:loading wire:target="update">
                        Updating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>