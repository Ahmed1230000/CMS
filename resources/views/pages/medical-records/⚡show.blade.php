<?php

use App\Domains\MedicalRecord\DTOs\MedicalRecord\ShowMedicalRecordDTO;
use App\Domains\MedicalRecord\UseCases\ShowMedicalRecordUseCase\ShowMedicalRecordUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowMedicalRecordUseCase $showMedicalRecordUseCase;

    public int $medical_record_id;

    public function boot(
        ShowMedicalRecordUseCase $showMedicalRecordUseCase
    ): void {
        $this->showMedicalRecordUseCase = $showMedicalRecordUseCase;
    }

    public function mount(string $id): void
    {
        $this->medical_record_id = (int) $id;
    }

    #[Computed]
    public function medicalRecord(): ShowMedicalRecordDTO
    {
        return $this->showMedicalRecordUseCase->execute(
            $this->medical_record_id
        );
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Medical Record Details
            </h1>

            <p class="mt-2 text-slate-500">
                View patient medical record information.
            </p>
        </div>

        <a
            href="{{ route('medical-records.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">
            Back
        </a>

    </div>


    {{-- Medical Record Card --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-6">

            <div>

                <p class="text-sm font-medium text-slate-500">
                    Medical Record
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    #{{ $this->medicalRecord->id }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $this->medicalRecord->patient_name }}
                </p>

            </div>

            {{-- Status --}}
            @if ($this->medicalRecord->status->value === 'draft')

            <span class="rounded-full bg-amber-100 px-4 py-2 text-sm font-medium text-amber-700">
                Draft
            </span>

            @elseif ($this->medicalRecord->status->value === 'finalized')

            <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-medium text-green-700">
                Finalized
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
                    #{{ $this->medicalRecord->id }}
                </p>

            </div>


            {{-- Patient --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Patient
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->medicalRecord->patient_name ?: 'Unknown' }}
                </p>

            </div>


            {{-- Phone --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Phone
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->medicalRecord->patient_phone ?: 'No phone provided.' }}
                </p>

            </div>


            {{-- Chief Complaint --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Chief Complaint
                </p>

                <p class="mt-2 whitespace-pre-line text-slate-700">
                    {{ $this->medicalRecord->chief_complaint ?: 'No chief complaint provided.' }}
                </p>

            </div>


            {{-- Diagnosis --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Diagnosis
                </p>

                <p class="mt-2 whitespace-pre-line text-slate-700">
                    {{ $this->medicalRecord->diagnosis ?: 'No diagnosis provided.' }}
                </p>

            </div>


            {{-- Clinical Notes --}}
            <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">

                <p class="text-sm font-medium text-slate-500">
                    Clinical Notes
                </p>

                <p class="mt-2 whitespace-pre-line text-slate-700">
                    {{ $this->medicalRecord->clinical_notes ?: 'No clinical notes provided.' }}
                </p>

            </div>


            {{-- Treatment Plan --}}
            <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">

                <p class="text-sm font-medium text-slate-500">
                    Treatment Plan
                </p>

                <p class="mt-2 whitespace-pre-line text-slate-700">
                    {{ $this->medicalRecord->treatment_plan ?: 'No treatment plan provided.' }}
                </p>

            </div>


            {{-- Created By --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created By
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->medicalRecord->creator_name ?: 'Unknown' }}
                </p>

            </div>


            {{-- Created At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->medicalRecord->created_at?->format('Y-m-d H:i:s') }}
                </p>

            </div>


            {{-- Updated At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Updated At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->medicalRecord->updated_at?->format('Y-m-d H:i:s') }}
                </p>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('medical-records.index') }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">
                Back
            </a>

            <a
                href="{{ route('medical-records.update', ['id' => $this->medicalRecord->id]) }}"
                wire:navigate
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                Update
            </a>

        </div>

    </div>

</div>