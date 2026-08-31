<?php

use App\Domains\Appointment\DTOs\Appointment\AppointmentDTO;
use App\Domains\Appointment\UseCases\Appointment\CreateAppointmentUseCase;
use App\Domains\Doctor\UseCases\ListDoctorsUseCase\ListDoctorsUseCase;
use App\Domains\Patient\UseCases\ListPatientsUseCase\ListPatientsUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected CreateAppointmentUseCase $createAppointmentUseCase;

    protected ListDoctorsUseCase $listDoctorsUseCase;

    protected ListPatientsUseCase $listPatientsUseCase;

    public string $doctor_id = '';

    public string $patient_id = '';

    public string $department_id = '';

    public string $appointment_date = '';

    public string $start_time = '';

    public string $end_time = '';

    public string $reason = '';

    public string $notes = '';

    public function boot(
        CreateAppointmentUseCase $createAppointmentUseCase,
        ListDoctorsUseCase $listDoctorsUseCase,
        ListPatientsUseCase $listPatientsUseCase
    ): void {
        $this->createAppointmentUseCase = $createAppointmentUseCase;

        $this->listDoctorsUseCase = $listDoctorsUseCase;

        $this->listPatientsUseCase = $listPatientsUseCase;
    }

    public function updatedDoctorId($value): void
    {
        if (!$value) {
            $this->department_id = '';

            return;
        }

        $doctor = collect($this->listDoctorsUseCase->execute())
            ->firstWhere('id', (int) $value);

        $this->department_id = $doctor?->department_id
            ? (string) $doctor->department_id
            : '';
    }

    protected function rules(): array
    {
        return [
            'doctor_id' => [
                'required',
                'integer',
                'exists:doctors,id',
            ],

            'patient_id' => [
                'required',
                'integer',
                'exists:patients,id',
            ],

            // 'department_id' => [
            //     'required',
            //     'integer',
            //     'exists:departments,id',
            // ],

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

    public function create()
    {
        $validated = $this->validate($this->rules());

        try {
            $dto = AppointmentDTO::fromArray($validated);

            $this->createAppointmentUseCase->execute($dto);

            session()->flash(
                'success',
                'Appointment created successfully.'
            );

            return redirect()->route(
                'appointments.index'
            );
        } catch (\Throwable $exception) {

            $this->addError(
                'appointment',
                $exception->getMessage()
            );
        }
    }

    public function doctors()
    {
        return $this->listDoctorsUseCase->execute();
    }

    public function patients()
    {
        return $this->listPatientsUseCase->execute();
    }
};
?>

<div class="max-w-5xl">

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Create Appointment
            </h1>

            <p class="mt-2 text-slate-500">
                Schedule a new appointment for a patient.
            </p>

        </div>

        <a
            href="{{ route('appointments.index') }}"
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


    <form wire:submit="create">

        <div class="space-y-6">


            {{-- Appointment Participants --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Appointment Participants
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Select the patient and doctor for this appointment.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">


                    {{-- Patient --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Patient
                        </label>

                        <select
                            wire:model.live="patient_id"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                            <option value="">
                                Select patient
                            </option>

                            @foreach ($this->patients() as $patient)

                            @if ($patient->is_active)

                            <option value="{{ $patient->id }}">
                                #{{ $patient->patient_number }} -
                                {{ $patient->name }}
                            </option>

                            @endif

                            @endforeach

                        </select>

                        @error('patient_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Doctor --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Doctor
                        </label>

                        <select
                            wire:model.live="doctor_id"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                            <option value="">
                                Select doctor
                            </option>

                            @foreach ($this->doctors() as $doctor)

                            @if ($doctor->is_active)

                            <option value="{{ $doctor->id }}">
                                #{{ $doctor->id }} -
                                {{ $doctor->specialization }}
                            </option>

                            @endif

                            @endforeach

                        </select>

                        @error('doctor_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Department --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Department
                        </label>

                        <input
                            type="text"
                            value="{{ $department_id ? 'Department ID: ' . $department_id : 'Will be selected automatically from the doctor' }}"
                            readonly
                            class="w-full cursor-not-allowed rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-600">

                        @error('department_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Schedule --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Schedule
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Select the date and time for the appointment.
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


            {{-- Details --}}
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
                            rows="5"
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


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('appointments.index') }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove>
                        Create Appointment
                    </span>

                    <span wire:loading>
                        Creating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>