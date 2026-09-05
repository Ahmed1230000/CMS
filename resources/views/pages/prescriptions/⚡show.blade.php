<?php

use App\Domains\Prescription\DTOs\Prescription\ShowPrescriptionDTO;
use App\Domains\Prescription\UseCases\ShowPrescriptionUseCase\ShowPrescriptionUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowPrescriptionUseCase $showPrescriptionUseCase;

    public int $prescription_id;

    public function boot(
        ShowPrescriptionUseCase $showPrescriptionUseCase
    ): void {
        $this->showPrescriptionUseCase = $showPrescriptionUseCase;
    }

    public function mount(string $id): void
    {
        $this->prescription_id = (int) $id;
    }

    #[Computed]
    public function prescription(): ShowPrescriptionDTO
    {
        return $this->showPrescriptionUseCase->execute(
            $this->prescription_id
        );
    }
};

?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Prescription Details
            </h1>

            <p class="mt-2 text-slate-500">
                View prescription information.
            </p>
        </div>

        <a
            href="{{ route('prescriptions.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">
            Back
        </a>

    </div>


    {{-- Prescription Card --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-6">

            <div>
                <p class="text-sm font-medium text-slate-500">
                    Prescription
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    #{{ $this->prescription->id }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Created at {{ $this->prescription->created_at }}
                </p>
            </div>


            {{-- Status --}}
            @switch($this->prescription->status)

            @case('active')
            <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-medium text-green-700">
                Active
            </span>
            @break

            @case('cancelled')
            <span class="rounded-full bg-red-100 px-4 py-2 text-sm font-medium text-red-700">
                Cancelled
            </span>
            @break

            @endswitch

        </div>


        {{-- Information --}}
        <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

            {{-- ID --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    ID
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->prescription->id }}
                </p>

            </div>


            {{-- Patient --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Patient
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->prescription->patient_name }}
                </p>

            </div>


            {{-- Doctor --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Doctor
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->prescription->doctor_name }}
                </p>

            </div>


            {{-- Appointment --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Appointment Date
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->prescription->appointment_date }}
                </p>

            </div>


            {{-- Status --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Status
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800 capitalize">
                    {{ $this->prescription->status }}
                </p>

            </div>


            {{-- Created By --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created By
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->prescription->created_by ?: 'N/A' }}
                </p>

            </div>


            {{-- Created At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->prescription->created_at }}
                </p>

            </div>


            {{-- Updated At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Updated At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->prescription->updated_at }}
                </p>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('prescriptions.index') }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">
                Back
            </a>

            <a
                href="{{ route('prescriptions.items.index', [
                        'prescription' => $this->prescription->id
                        ]) }}"
                wire:navigate
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">
                View Items
            </a>

            @if ($this->prescription->status === 'active')

            @endif

        </div>

    </div>

</div>