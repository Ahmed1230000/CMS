<?php

use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Domains\Appointment\UseCases\ShowAppointmentUseCase\ShowAppointmentUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowAppointmentUseCase $showAppointmentUseCase;

    public int $appointment_id;

    public function boot(
        ShowAppointmentUseCase $showAppointmentUseCase
    ): void {
        $this->showAppointmentUseCase = $showAppointmentUseCase;
    }

    public function mount(string $id): void
    {
        $this->appointment_id = (int) $id;
    }

    #[Computed]
    public function appointment()
    {
        return $this->showAppointmentUseCase->execute(
            $this->appointment_id
        );
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Appointment Details
            </h1>

            <p class="mt-2 text-slate-500">
                View appointment information.
            </p>

        </div>

        <a
            href="{{ route('appointments.index') }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>


    {{-- Appointment Card --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-8 py-6">

            <div>

                <p class="text-sm font-medium text-slate-500">
                    Appointment
                </p>

                <h2 class="mt-1 text-2xl font-bold text-slate-800">
                    #{{ $this->appointment->id }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    {{ $this->appointment->appointment_date->format('Y-m-d') }}
                </p>

            </div>


            {{-- Status --}}
            @switch($this->appointment->status)

            @case('scheduled')

            <span class="rounded-full bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700">
                Scheduled
            </span>

            @break

            @case('confirmed')

            <span class="rounded-full bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700">
                Confirmed
            </span>

            @break

            @case('completed')

            <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-medium text-green-700">
                Completed
            </span>

            @break

            @case('cancelled')

            <span class="rounded-full bg-red-100 px-4 py-2 text-sm font-medium text-red-700">
                Cancelled
            </span>

            @break

            @case('no_show')

            <span class="rounded-full bg-amber-100 px-4 py-2 text-sm font-medium text-amber-700">
                No Show
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
                    #{{ $this->appointment->id }}
                </p>

            </div>


            {{-- Doctor --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Doctor
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->appointment->doctor_name }}
                </p>

            </div>


            {{-- Patient --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Patient
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->appointment->patient_name }}
                </p>

            </div>


            {{-- Department --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Department
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->appointment->department_name }}
                </p>

            </div>


            {{-- Date --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Appointment Date
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->appointment->appointment_date->format('Y-m-d') }}
                </p>

            </div>


            {{-- Start Time --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Start Time
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->appointment->start_time->format('H:i') }}
                </p>

            </div>


            {{-- End Time --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    End Time
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    {{ $this->appointment->end_time->format('H:i') }}
                </p>

            </div>


            {{-- Reason --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Reason
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->appointment->reason ?: 'No reason provided.' }}
                </p>

            </div>


            {{-- Notes --}}
            <div class="rounded-xl border border-slate-200 p-5 md:col-span-2">

                <p class="text-sm font-medium text-slate-500">
                    Notes
                </p>

                <p class="mt-2 whitespace-pre-line text-slate-700">
                    {{ $this->appointment->notes ?: 'No notes provided.' }}
                </p>

            </div>


            {{-- Created By --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created By
                </p>

                <p class="mt-2 text-lg font-semibold text-slate-800">
                    #{{ $this->appointment->creator_name }}
                </p>

            </div>


            {{-- Created At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Created At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->appointment->created_at->format('Y-m-d H:i:s') }}
                </p>

            </div>


            {{-- Updated At --}}
            <div class="rounded-xl border border-slate-200 p-5">

                <p class="text-sm font-medium text-slate-500">
                    Updated At
                </p>

                <p class="mt-2 text-slate-700">
                    {{ $this->appointment->updated_at->format('Y-m-d H:i:s') }}
                </p>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex items-center justify-end gap-4 border-t border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('appointments.index') }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                Back

            </a>

            <a
                href="{{ route('appointments.update', ['id' => $this->appointment->id]) }}"
                wire:navigate
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                Update

            </a>

        </div>

    </div>

</div>