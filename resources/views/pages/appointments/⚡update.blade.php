<?php

use App\Domains\Appointment\DTOs\Appointment\AppointmentDTO;
use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;
use App\Domains\Appointment\UseCases\Appointment\UpdateAppointmentUseCase;
use App\Domains\Appointment\UseCases\ShowAppointmentUseCase\ShowAppointmentUseCase;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;
use App\Domains\Department\Repositories\Contracts\Department\DepartmentRepositoryInterface;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowAppointmentUseCase $showAppointmentUseCase;

    protected UpdateAppointmentUseCase $updateAppointmentUseCase;

    protected DoctorRepositoryInterface $doctorRepository;

    protected PatientRepositoryInterface $patientRepository;

    protected DepartmentRepositoryInterface $departmentRepository;

    protected AppointmentRepositoryInterface $appointmentRepositoryInterface;

    public int $appointment_id;

    public string $appointment_date = '';

    public string $start_time = '';

    public string $end_time = '';

    public string $reason = '';

    public string $notes = '';

    public string $doctor_name = '';

    public string $patient_name = '';

    public string $department_name = '';

    public function boot(
        ShowAppointmentUseCase $showAppointmentUseCase,
        UpdateAppointmentUseCase $updateAppointmentUseCase,
        DoctorRepositoryInterface $doctorRepository,
        PatientRepositoryInterface $patientRepository,
        DepartmentRepositoryInterface $departmentRepository,
        AppointmentRepositoryInterface $appointmentRepositoryInterface,

    ): void {
        $this->showAppointmentUseCase = $showAppointmentUseCase;

        $this->updateAppointmentUseCase = $updateAppointmentUseCase;

        $this->doctorRepository = $doctorRepository;

        $this->patientRepository = $patientRepository;

        $this->departmentRepository = $departmentRepository;

        $this->appointmentRepositoryInterface = $appointmentRepositoryInterface;
    }

    public function mount(string $id): void
    {
        $this->appointment_id = (int) $id;

        $appointment = $this->appointmentRepositoryInterface->find(
            $this->appointment_id
        );

        $this->appointment_date = $appointment->appointment_date->format('Y-m-d');

        $this->start_time = $appointment->start_time->format('H:i');

        $this->end_time = $appointment->end_time->format('H:i');

        $this->reason = $appointment->reason ?? '';

        $this->notes = $appointment->notes ?? '';
    }
    /*
        |--------------------------------------------------------------------------
        | Read-only information
        |--------------------------------------------------------------------------
        */
    #[Computed]
    public function appointment()
    {
        return $this->showAppointmentUseCase->execute(
            $this->appointment_id
        );
    }

    protected function rules(): array
    {
        return [
            'appointment_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'reason' => [
                'nullable',
                'string',
                'max:255',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function update()
    {
        $validated = $this->validate(
            $this->rules()
        );

        try {
            $appointmentEntity = $this->appointmentRepositoryInterface->find(
                $this->appointment_id
            );

            $dto = AppointmentDTO::fromArray($validated);

            $this->updateAppointmentUseCase->execute(
                $dto,
                $appointmentEntity
            );

            session()->flash(
                'success',
                'Appointment updated successfully.'
            );

            return redirect()->route(
                'appointments.show',
                ['id' => $this->appointment_id]
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

<div class="max-w-5xl">

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Appointment
            </h1>

            <p class="mt-2 text-slate-500">
                Update appointment schedule and details.
            </p>

        </div>

        <a
            href="{{ route('appointments.show', ['id' => $appointment_id]) }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>


    {{-- Error --}}
    @error('appointment')

    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

        {{ $message }}

    </div>

    @enderror


    <form wire:submit="update">

        <div class="space-y-6">


            {{-- Schedule --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Appointment Schedule
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Update the appointment date and time.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-3">


                    {{-- Date --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Appointment Date
                        </label>

                        <input
                            type="date"
                            wire:model.live="appointment_date"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('appointment_date')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- Start --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Start Time
                        </label>

                        <input
                            type="time"
                            wire:model.live="start_time"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('start_time')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- End --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            End Time
                        </label>

                        <input
                            type="time"
                            wire:model.live="end_time"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('end_time')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- Appointment Details --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Appointment Details
                    </h2>

                </div>


                <div class="space-y-6 p-8">


                    {{-- Reason --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Reason
                        </label>

                        <input
                            type="text"
                            wire:model.live="reason"
                            placeholder="e.g. Follow-up consultation"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('reason')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- Notes --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Notes
                        </label>

                        <textarea
                            wire:model.live="notes"
                            rows="6"
                            placeholder="Additional notes..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                        @error('notes')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- Read Only Information --}}
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Doctor
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            #{{ $this->appointment->doctor_name ?? '' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Patient
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            #{{ $this->appointment->patient_name ?? '' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Department
                        </p>

                        <p class="mt-1 font-semibold text-slate-800">
                            #{{ $this->appointment->department_name ?? '' }}
                        </p>

                    </div>

                </div>

                <p class="mt-4 text-xs text-slate-500">
                    Doctor, patient, department, and status are not changed through the standard appointment update.
                </p>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('appointments.show', ['id' => $appointment_id]) }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove>
                        Update Appointment
                    </span>

                    <span wire:loading>
                        Updating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>