<?php

use App\Domains\Patient\UseCases\GetPatientMedicalDocumentsUseCase\GetPatientMedicalDocumentsUseCase;
use App\Domains\Patient\UseCases\ShowPatientUseCase\ShowPatientUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowPatientUseCase $showPatientUseCase;

    protected GetPatientMedicalDocumentsUseCase $getPatientMedicalDocumentsUseCase;

    public int $patient_id;

    public function boot(
        ShowPatientUseCase $showPatientUseCase,
        GetPatientMedicalDocumentsUseCase $getPatientMedicalDocumentsUseCase
    ): void {
        $this->showPatientUseCase = $showPatientUseCase;

        $this->getPatientMedicalDocumentsUseCase = $getPatientMedicalDocumentsUseCase;
    }

    public function mount(string $id): void
    {
        $this->patient_id = (int) $id;
    }

    #[Computed]
    public function patient()
    {
        return $this->showPatientUseCase->execute(
            $this->patient_id
        );
    }

    #[Computed]
    public function medicalDocuments()
    {
        return $this->getPatientMedicalDocumentsUseCase->execute(
            $this->patient_id
        );
    }
};

?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Patient Details
            </h1>

            <p class="mt-2 text-slate-500">
                View patient information and medical documents.
            </p>

        </div>

        <a
            href="{{ route('patients.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">
            Back
        </a>

    </div>


    {{-- Patient Card --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-6">

            <div>

                <p class="text-sm font-medium text-slate-500">
                    Patient
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    {{ $this->patient->name }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $this->patient->patient_number }}
                </p>

            </div>

            @if ($this->patient->is_active)

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
                    #{{ $this->patient->id }}
                </p>

            </div>


            {{-- Patient Number --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Patient Number
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->patient->patient_number }}
                </p>

            </div>


            {{-- Name --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Full Name
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->patient->name }}
                </p>

            </div>


            {{-- Phone --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Phone
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->patient->phone }}
                </p>

            </div>


            {{-- Email --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Email
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->patient->email ?: 'No email provided.' }}
                </p>

            </div>


            {{-- Gender --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Gender
                </p>

                <p class="mt-2 text-slate-700">
                    {{ ucfirst($this->patient->gender) }}
                </p>

            </div>


            {{-- Date Of Birth --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Date Of Birth
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->patient->date_of_birth->format('Y-m-d') }}
                </p>

            </div>


            {{-- National ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    National ID
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->patient->national_id }}
                </p>

            </div>


            {{-- Address --}}
            <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">

                <p class="text-sm font-medium text-slate-500">
                    Address
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->patient->address ?: 'No address provided.' }}
                </p>

            </div>


            {{-- Created By --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created By
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->patient->creator_name }}
                </p>

            </div>


            {{-- Created At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->patient->created_at->format('Y-m-d H:i:s') }}
                </p>

            </div>


            {{-- Updated At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Updated At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->patient->updated_at->format('Y-m-d H:i:s') }}
                </p>

            </div>

        </div>


        {{-- Medical Documents --}}
        <div class="border-t border-slate-200">

            <div class="border-b border-slate-200 px-8 py-6">

                <h2 class="text-lg font-semibold text-slate-800">
                    Medical Documents
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Documents uploaded for this patient.
                </p>

            </div>


            <div class="p-8">

                @forelse ($this->medicalDocuments as $document)

                <div
                    wire:key="medical-document-{{ $document->id }}"
                    class="mb-3 flex items-center justify-between rounded-xl border border-slate-200 bg-slate-50 p-4 last:mb-0">

                    <div>

                        <p class="font-medium text-slate-800">
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


                    <div class="flex items-center gap-2">

                        <a
                            href="{{ route('patients.documents.view', [
                                'patient' => $this->patient->id,
                                'media' => $document->id,]) }}"
                            target="_blank"
                            class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">
                            View
                        </a>

                        <a
                            href="{{ route('patients.documents.download', [
                                    'patient' => $this->patient->id,
                                    'media' => $document->id,]) }}"
                            class="rounded-lg bg-slate-200 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-300">
                            Download
                        </a>

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
        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('patients.index') }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                Back

            </a>

            <a
                href="{{ route('patients.update', ['id' => $this->patient->id]) }}"
                wire:navigate
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                Update

            </a>

        </div>

    </div>

</div>