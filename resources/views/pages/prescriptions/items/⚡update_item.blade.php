<?php

use App\Domains\Prescription\DTOs\PrescriptionItem\PrescriptionItemDTO;
use App\Domains\Prescription\UseCases\PrescriptionItem\UpdatePrescriptionItemUseCase;
use App\Domains\Prescription\Repositories\Contracts\PrescriptionItem\PrescriptionItemRepositoryInterface;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected UpdatePrescriptionItemUseCase $updatePrescriptionItemUseCase;

    protected PrescriptionItemRepositoryInterface $repository;

    public int $prescription_id;

    public int $item_id;

    public string $medication_name = '';

    public string $dosage = '';

    public string $frequency = '';

    public string $duration = '';

    public string $instructions = '';

    public function boot(
        UpdatePrescriptionItemUseCase $updatePrescriptionItemUseCase,
        PrescriptionItemRepositoryInterface $repository,
    ): void {
        $this->updatePrescriptionItemUseCase = $updatePrescriptionItemUseCase;

        $this->repository = $repository;
    }

    public function mount(
        string $prescription,
        string $item
    ): void {
        $this->prescription_id = (int) $prescription;

        $this->item_id = (int) $item;

        $item = $this->repository->find($this->item_id);

        abort_unless(
            $item->prescription_id === $this->prescription_id,
            404
        );

        $this->medication_name = $item->medication_name;

        $this->dosage = $item->dosage;

        $this->frequency = $item->frequency;

        $this->duration = $item->duration;

        $this->instructions = $item->instructions ?? '';
    }

    protected function rules(): array
    {
        return [
            'medication_name' => [
                'required',
                'string',
                'max:255',
            ],

            'dosage' => [
                'required',
                'string',
                'max:255',
            ],

            'frequency' => [
                'required',
                'string',
                'max:255',
            ],

            'duration' => [
                'required',
                'string',
                'max:255',
            ],

            'instructions' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function update()
    {
        $validated = $this->validate($this->rules());

        try {

            $dto = PrescriptionItemDTO::fromArray([
                'prescription_id' => $this->prescription_id,
                'medication_name' => $validated['medication_name'],
                'dosage'          => $validated['dosage'],
                'frequency'       => $validated['frequency'],
                'duration'        => $validated['duration'],
                'instructions'    => $validated['instructions'] ?? null,
            ]);

            $this->updatePrescriptionItemUseCase->execute(
                $this->item_id,
                $dto
            );

            session()->flash(
                'success',
                'Prescription item updated successfully.'
            );

            return redirect()->route(
                'prescriptions.items.index',
                [
                    'prescription' => $this->prescription_id,
                ]
            );
        } catch (\Throwable $exception) {

            $this->addError(
                'prescription_item',
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
                Edit Medication
            </h1>

            <p class="mt-2 text-slate-500">
                Update medication details for Prescription #{{ $prescription_id }}.
            </p>

        </div>

        <a
            href="{{ route('prescriptions.items.index', [
                'prescription' => $prescription_id
            ]) }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Cancel

        </a>

    </div>


    {{-- Error --}}
    @error('prescription_item')

    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
        {{ $message }}
    </div>

    @enderror


    <form wire:submit="update">

        <div class="space-y-6">


            {{-- Medication Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Medication Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Update the medication and prescription instructions.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">


                    {{-- Medication Name --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Medication Name
                        </label>

                        <input
                            type="text"
                            wire:model.live="medication_name"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('medication_name')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Dosage --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Dosage
                        </label>

                        <input
                            type="text"
                            wire:model.live="dosage"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('dosage')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Frequency --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Frequency
                        </label>

                        <input
                            type="text"
                            wire:model.live="frequency"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('frequency')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Duration --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Duration
                        </label>

                        <input
                            type="text"
                            wire:model.live="duration"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none">

                        @error('duration')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Instructions --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-slate-700">
                            Instructions
                        </label>

                        <textarea
                            wire:model.live="instructions"
                            rows="5"
                            placeholder="e.g. Take after meals..."
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none"></textarea>

                        @error('instructions')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Prescription Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-8 py-6">

                    <h2 class="text-lg font-semibold text-slate-800">
                        Prescription Information
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        This medication belongs to the selected prescription.
                    </p>

                </div>

                <div class="p-8">

                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-5 py-4">

                        <p class="text-sm text-slate-500">
                            Prescription
                        </p>

                        <p class="mt-1 text-lg font-semibold text-slate-800">
                            #{{ $prescription_id }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex items-center justify-end gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-8 py-5">

                <a
                    href="{{ route('prescriptions.items.index', [
                        'prescription' => $prescription_id
                    ]) }}"
                    wire:navigate
                    class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                    Cancel

                </a>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50">

                    <span wire:loading.remove>
                        Update Medication
                    </span>

                    <span wire:loading>
                        Updating...
                    </span>

                </button>

            </div>

        </div>

    </form>

</div>