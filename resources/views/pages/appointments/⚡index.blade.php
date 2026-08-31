<?php

use App\Domains\Appointment\UseCases\Appointment\DeleteAppointmentUseCase;
use App\Domains\Appointment\UseCases\ListAppointmentsUseCase\ListAppointmentsUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ListAppointmentsUseCase $listAppointmentsUseCase;

    protected DeleteAppointmentUseCase $deleteAppointmentUseCase;

    public function boot(
        ListAppointmentsUseCase $listAppointmentsUseCase,
        DeleteAppointmentUseCase $deleteAppointmentUseCase
    ): void {
        $this->listAppointmentsUseCase = $listAppointmentsUseCase;

        $this->deleteAppointmentUseCase = $deleteAppointmentUseCase;
    }

    #[Computed]
    public function appointments()
    {
        return $this->listAppointmentsUseCase->execute();
    }

    public function delete(int|string $id): void
    {
        try {
            $this->deleteAppointmentUseCase->execute((int) $id);

            unset($this->appointments);

            session()->flash(
                'success',
                'Appointment deleted successfully.'
            );
        } catch (\Throwable $exception) {

            $this->addError(
                'appointment',
                $exception->getMessage()
            );
        }
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Appointments
            </h1>

            <p class="mt-2 text-slate-500">
                Manage hospital appointments.
            </p>

        </div>

        <a
            href="{{ route('appointments.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">

            + Create Appointment

        </a>

    </div>


    {{-- Appointments Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full">

            <thead class="border-b bg-slate-50">

                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        #ID
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Doctor
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Patient
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Department
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Date
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                        Time
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

                @forelse ($this->appointments as $appointment)

                <tr class="border-b last:border-b-0">

                    {{-- ID --}}
                    <td class="px-6 py-4">
                        {{ $appointment->id }}
                    </td>


                    {{-- Doctor --}}
                    <td class="px-6 py-4">
                        #{{ $appointment->doctor_name }}
                    </td>


                    {{-- Patient --}}
                    <td class="px-6 py-4">
                        #{{ $appointment->patient_name }}
                    </td>


                    {{-- Department --}}
                    <td class="px-6 py-4">
                        #{{ $appointment->department_name }}
                    </td>


                    {{-- Date --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $appointment->appointment_date->format('Y-m-d') }}
                    </td>


                    {{-- Time --}}
                    <td class="px-6 py-4 text-slate-600">
                        {{ $appointment->start_time->format('H:i') }}
                        -
                        {{ $appointment->end_time->format('H:i') }}
                    </td>


                    {{-- Status --}}
                    <td class="px-6 py-4">

                        @switch($appointment->status)

                        @case('scheduled')

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                            Scheduled
                        </span>

                        @break

                        @case('confirmed')

                        <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-medium text-indigo-700">
                            Confirmed
                        </span>

                        @break

                        @case('completed')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                            Completed
                        </span>

                        @break

                        @case('cancelled')

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                            Cancelled
                        </span>

                        @break

                        @case('no_show')

                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                            No Show
                        </span>

                        @break

                        @endswitch

                    </td>


                    {{-- Actions --}}
                    <td class="px-6 py-4">

                        <div class="flex items-center gap-2">

                            <a
                                href="{{ route('appointments.show', $appointment->id) }}"
                                wire:navigate
                                class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">

                                View

                            </a>

                            <a
                                href="{{ route('appointments.update', $appointment->id) }}"
                                wire:navigate
                                class="rounded-lg bg-blue-100 px-3 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">

                                Update

                            </a>

                            <button
                                type="button"
                                wire:click="delete({{ $appointment->id }})"
                                wire:confirm="Are you sure you want to delete this appointment?"
                                wire:loading.attr="disabled"
                                class="rounded-lg bg-red-100 px-3 py-2 text-sm font-medium text-red-700 transition hover:bg-red-200 disabled:opacity-50">

                                Delete

                            </button>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="8"
                        class="px-6 py-12 text-center text-slate-500">

                        No appointments found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">

        {{ $this->appointments->links() }}

    </div>

</div>