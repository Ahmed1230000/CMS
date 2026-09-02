<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\MedicalRecord\DTOs\MedicalRecord\MedicalRecordDTO;
use App\Domains\MedicalRecord\UseCases\MedicalRecord\CreateMedicalRecordUseCase;
use App\Domains\Patient\UseCases\SearchPatientsByPhoneUseCase\SearchPatientsByPhoneUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected CreateMedicalRecordUseCase $createMedicalRecordUseCase;

    protected SearchPatientsByPhoneUseCase $searchPatientsByPhoneUseCase;

    public string $phone = '';

    public string $searchedPhone = '';

    public ?int $patient_id = null;

    public ?array $selectedPatient = null;

    public $patients;

    public string $chief_complaint = '';

    public string $diagnosis = '';

    public string $clinical_notes = '';

    public string $treatment_plan = '';

    public function mount(): void
    {
        $this->patients = collect();
    }

    public function boot(
        CreateMedicalRecordUseCase $createMedicalRecordUseCase,
        SearchPatientsByPhoneUseCase $searchPatientsByPhoneUseCase
    ): void {
        $this->createMedicalRecordUseCase = $createMedicalRecordUseCase;

        $this->searchPatientsByPhoneUseCase = $searchPatientsByPhoneUseCase;
    }

    protected function rules(): array
    {
        return [
            'patient_id' => [
                'required',
                'integer',
                'exists:patients,id',
            ],

            'chief_complaint' => [
                'nullable',
                'string',
            ],

            'diagnosis' => [
                'nullable',
                'string',
            ],

            'clinical_notes' => [
                'nullable',
                'string',
            ],

            'treatment_plan' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function searchPatient(): void
    {
        $this->searchedPhone = trim($this->phone);

        $this->patient_id = null;
        $this->selectedPatient = null;

        $this->patients = $this->searchPatientsByPhoneUseCase->execute(
            $this->searchedPhone
        );
    }

    public function selectPatient(int $patientId): void
    {
        $patient = $this->patients->firstWhere(
            'id',
            $patientId
        );

        if (!$patient) {
            return;
        }

        $this->patient_id = (int) $patient->id;

        $this->selectedPatient = [
            'id' => (int) $patient->id,
            'name' => $patient->name,
            'phone' => $patient->phone,
        ];

        $this->phone = $patient->phone;

        $this->patients = collect();
    }

    public function create()
    {
        $validated = $this->validate(
            $this->rules()
        );

        try {
            $dto = MedicalRecordDTO::fromArray($validated);

            $medicalRecord = $this->createMedicalRecordUseCase->execute(
                $dto
            );

            session()->flash(
                'success',
                'Medical record created successfully.'
            );

            return redirect()->route(
                'medical-records.show',
                ['id' => $medicalRecord->id]
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
                Create Medical Record
            </h1>

            <p class="mt-2 text-slate-500">
                Create a medical record for a patient.
            </p>
        </div>

        <a
            href="{{ route('medical-records.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>


    {{-- Global Error --}}
    @error('medical_record')

    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
        {{ $message }}
    </div>

    @enderror


    {{-- Patient Search --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-8 py-6">

            <h2 class="text-lg font-semibold text-slate-800">
                Patient
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Search for the patient using their phone number.
            </p>

        </div>


        <div class="space-y-6 p-8">

            {{-- Search --}}
            <div class="flex gap-3">

                <input
                    type="text"
                    wire:model="phone"
                    placeholder="Enter patient phone number"
                    class="flex-1 rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                <button
                    type="button"
                    wire:click="searchPatient"
                    wire:loading.attr="disabled"
                    wire:target="searchPatient"
                    class="rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove wire:target="searchPatient">
                        Search
                    </span>

                    <span wire:loading wire:target="searchPatient">
                        Searching...
                    </span>

                </button>

            </div>


            {{-- Search Results --}}
            @if ($patients->isNotEmpty())

            <div class="space-y-2">

                @foreach ($patients as $patient)

                <div
                    wire:key="patient-{{ $patient->id }}"
                    wire:click="selectPatient({{ $patient->id }})"
                    class="flex w-full cursor-pointer items-center justify-between rounded-xl border border-slate-200 p-4 transition hover:bg-slate-50">

                    <div>

                        <p class="font-semibold text-slate-800">
                            {{ $patient->name }}
                        </p>

                        <p class="text-sm text-slate-500">
                            {{ $patient->phone }}
                        </p>

                    </div>

                    <span class="text-sm font-medium text-blue-600">
                        Select
                    </span>

                </div>

                @endforeach

            </div>

            @elseif ($searchedPhone !== '')

            <div class="rounded-xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-500">
                No patients found with this phone number.
            </div>

            @else

            <div class="rounded-xl border border-slate-200 bg-slate-50 px-5 py-4 text-sm text-slate-500">
                Enter a phone number to search for a patient.
            </div>

            @endif


            {{-- Selected Patient --}}
            @if ($selectedPatient)

            <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-blue-600">
                            Selected Patient
                        </p>

                        <p class="mt-1 text-lg font-semibold text-slate-800">
                            {{ $selectedPatient['name'] }}
                        </p>

                        <p class="mt-1 text-sm text-slate-600">
                            {{ $selectedPatient['phone'] }}
                        </p>

                    </div>

                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                        Selected
                    </span>

                </div>

            </div>

            @endif


            @error('patient_id')

            <p class="text-sm text-red-600">
                {{ $message }}
            </p>

            @enderror

        </div>

    </div>


    {{-- Medical Record Form --}}
    <form wire:submit="create">

        <div class="space-y-6">


            {{-- Clinical Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Clinical Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Enter the patient's medical information.
                    </p>

                </div>


                <div class="space-y-6 p-8">

                    {{-- Chief Complaint --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Chief Complaint
                        </label>

                        <textarea
                            wire:model.live="chief_complaint"
                            rows="4"
                            placeholder="Describe the patient's main complaint..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                        @error('chief_complaint')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- Diagnosis --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Diagnosis
                        </label>

                        <textarea
                            wire:model.live="diagnosis"
                            rows="4"
                            placeholder="Enter diagnosis..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                        @error('diagnosis')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- Clinical Notes --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Clinical Notes
                        </label>

                        <textarea
                            wire:model.live="clinical_notes"
                            rows="6"
                            placeholder="Add clinical notes..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                        @error('clinical_notes')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- Treatment Plan --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Treatment Plan
                        </label>

                        <textarea
                            wire:model.live="treatment_plan"
                            rows="6"
                            placeholder="Enter treatment plan..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                        @error('treatment_plan')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- Information --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">

                <p class="text-sm text-slate-600">
                    New medical records are created with
                    <strong>Draft</strong>
                    status automatically.
                </p>

                <p class="mt-2 text-sm text-slate-600">
                    The record creator is taken automatically from the authenticated user.
                </p>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('medical-records.index') }}"
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
                        Create Medical Record
                    </span>

                    <span wire:loading wire:target="create">
                        Creating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>