<?php

use App\Common\Traits\FlashMessageException;
use App\Domains\MedicalRecord\DTOs\MedicalRecord\MedicalRecordDTO;
use App\Domains\MedicalRecord\DTOs\MedicalRecord\ShowMedicalRecordDTO;
use App\Domains\MedicalRecord\UseCases\ShowMedicalRecordUseCase\ShowMedicalRecordUseCase;
use App\Domains\MedicalRecord\UseCases\MedicalRecord\UpdateMedicalRecordUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    use FlashMessageException;

    protected ShowMedicalRecordUseCase $showMedicalRecordUseCase;

    protected UpdateMedicalRecordUseCase $updateMedicalRecordUseCase;

    public int $medical_record_id;

    public ?int $patient_id = null;

    public string $chief_complaint = '';

    public string $diagnosis = '';

    public string $clinical_notes = '';

    public string $treatment_plan = '';

    public function boot(
        ShowMedicalRecordUseCase $showMedicalRecordUseCase,
        UpdateMedicalRecordUseCase $updateMedicalRecordUseCase
    ): void {
        $this->showMedicalRecordUseCase = $showMedicalRecordUseCase;

        $this->updateMedicalRecordUseCase = $updateMedicalRecordUseCase;
    }

    public function mount(string $id): void
    {
        $this->medical_record_id = (int) $id;

        $medicalRecord = $this->showMedicalRecordUseCase->execute(
            $this->medical_record_id
        );

        $this->patient_id = $medicalRecord->patient_id;

        $this->chief_complaint = $medicalRecord->chief_complaint ?? '';

        $this->diagnosis = $medicalRecord->diagnosis ?? '';

        $this->clinical_notes = $medicalRecord->clinical_notes ?? '';

        $this->treatment_plan = $medicalRecord->treatment_plan ?? '';
    }

    protected function rules(): array
    {
        return [
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

    public function update()
    {
        $validated = $this->validate(
            $this->rules()
        );

        try {
            $dto = MedicalRecordDTO::fromArray([
                'patient_id' => $this->patient_id,
                'chief_complaint' => $validated['chief_complaint'],
                'diagnosis' => $validated['diagnosis'],
                'clinical_notes' => $validated['clinical_notes'],
                'treatment_plan' => $validated['treatment_plan'],
            ]);

            $this->updateMedicalRecordUseCase->execute(
                $this->medical_record_id,
                $dto
            );

            session()->flash(
                'success',
                'Medical record updated successfully.'
            );

            return redirect()->route(
                'medical-records.show',
                ['id' => $this->medical_record_id]
            );
        } catch (\Throwable $exception) {
            dd($exception);
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
                Update Medical Record
            </h1>

            <p class="mt-2 text-slate-500">
                Update patient medical record information.
            </p>

        </div>

        <a
            href="{{ route('medical-records.show', ['id' => $medical_record_id]) }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>


    {{-- Patient Information --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-8 py-6">

            <h2 class="text-lg font-semibold text-slate-800">
                Patient
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                This medical record belongs to this patient.
            </p>

        </div>

        <div class="p-8">

            <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

                <p class="text-xs font-medium uppercase tracking-wide text-blue-600">
                    Patient ID
                </p>

                <p class="mt-1 text-lg font-semibold text-slate-800">
                    #{{ $patient_id }}
                </p>

            </div>

        </div>

    </div>


    {{-- Medical Record Form --}}
    <form wire:submit="update">

        <div class="space-y-6">

            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Clinical Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Update the patient's medical information.
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


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('medical-records.show', ['id' => $medical_record_id]) }}"
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
                        Update Medical Record
                    </span>

                    <span wire:loading wire:target="update">
                        Updating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>