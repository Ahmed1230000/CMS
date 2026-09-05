<?php

use App\Domains\MedicalRecord\UseCases\ListMedicalRecordsUseCase\ListMedicalRecordsUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ListMedicalRecordsUseCase $listMedicalRecordsUseCase;

    public function boot(
        ListMedicalRecordsUseCase $listMedicalRecordsUseCase
    ): void {
        $this->listMedicalRecordsUseCase = $listMedicalRecordsUseCase;
    }

    #[Computed]
    public function medicalRecords()
    {
        return $this->listMedicalRecordsUseCase->execute();
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Medical Records
            </h1>

            <p class="mt-2 text-slate-500">
                Manage patient medical records.
            </p>

        </div>

        <a
            href="{{ route('medical-records.create') }}"
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create Medical Record

        </a>

    </div>


    {{-- Medical Records Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        #ID
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Appointment
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Chief Complaint
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Diagnosis
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($this->medicalRecords as $medicalRecord)

                <tr class="border-b last:border-b-0">

                    {{-- ID --}}
                    <td class="px-6 py-4">
                        {{ $medicalRecord->id }}
                    </td>

                    {{-- Appointment --}}
                    <td class="px-6 py-4">

                        <a
                            href="{{ route('medical-records.show', $medicalRecord->id) }}"
                            wire:navigate
                            class="font-medium text-blue-600 transition hover:underline">

                            {{ $medicalRecord->patient_id }}

                        </a>

                    </td>

                    {{-- Chief Complaint --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $medicalRecord->chief_complaint ?: '—' }}
                    </td>

                    {{-- Diagnosis --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $medicalRecord->diagnosis ?: '—' }}
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">

                        @if ($medicalRecord->status?->value === 'draft')

                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                            Draft
                        </span>

                        @elseif ($medicalRecord->status?->value === 'finalized')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Finalized
                        </span>

                        @endif

                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('medical-records.show', $medicalRecord->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>

                            <a
                                href="{{ route('medical-records.update', $medicalRecord->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">

                                Update

                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="6"
                        class="px-6 py-12 text-center text-slate-500">

                        No medical records found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">
        {{ $this->medicalRecords->links() }}
    </div>

</div>