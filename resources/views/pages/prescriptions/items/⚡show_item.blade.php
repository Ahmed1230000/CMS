<?php

use App\Domains\Prescription\DTOs\PrescriptionItem\ShowPrescriptionItemDTO;
use App\Domains\Prescription\UseCases\ShowPrescriptionItemUseCase\ShowPrescriptionItemUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowPrescriptionItemUseCase $showPrescriptionItemUseCase;

    public int $item_id;

    public function boot(
        ShowPrescriptionItemUseCase $showPrescriptionItemUseCase
    ): void {
        $this->showPrescriptionItemUseCase = $showPrescriptionItemUseCase;
    }

    public function mount(string $item): void
    {
        $this->item_id = (int) $item;
    }

    #[Computed]
    public function item(): ShowPrescriptionItemDTO
    {
        return $this->showPrescriptionItemUseCase->execute(
            $this->item_id
        );
    }
};
?>

<div class="max-w-5xl">

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Prescription Item
            </h1>

            <p class="mt-2 text-slate-500">
                Medication details for Prescription #{{ $this->item->prescription_id }}.
            </p>

        </div>

        <a
            href="{{ route('prescriptions.items.index', [
                'prescription' => $this->item->prescription_id
            ]) }}"
            wire:navigate
            class="rounded-lg border border-slate-300 px-5 py-2 text-slate-700 transition hover:bg-slate-100">

            Back

        </a>

    </div>


    <div class="space-y-6">

        {{-- Medication Information --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-8 py-6">

                <h2 class="text-lg font-semibold text-slate-800">
                    Medication Information
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Details of the prescribed medication.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

                {{-- Medication --}}
                <div>

                    <p class="mb-2 text-sm font-medium text-slate-500">
                        Medication Name
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $this->item->medication_name }}
                    </p>

                </div>


                {{-- Dosage --}}
                <div>

                    <p class="mb-2 text-sm font-medium text-slate-500">
                        Dosage
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $this->item->dosage }}
                    </p>

                </div>


                {{-- Frequency --}}
                <div>

                    <p class="mb-2 text-sm font-medium text-slate-500">
                        Frequency
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $this->item->frequency }}
                    </p>

                </div>


                {{-- Duration --}}
                <div>

                    <p class="mb-2 text-sm font-medium text-slate-500">
                        Duration
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $this->item->duration }}
                    </p>

                </div>


                {{-- Status --}}
                <div>

                    <p class="mb-2 text-sm font-medium text-slate-500">
                        Status
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        {{ $this->item->status }}
                    </p>

                </div>


                {{-- Prescription --}}
                <div>

                    <p class="mb-2 text-sm font-medium text-slate-500">
                        Prescription ID
                    </p>

                    <p class="text-lg font-semibold text-slate-800">
                        #{{ $this->item->prescription_id }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Instructions --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-8 py-6">

                <h2 class="text-lg font-semibold text-slate-800">
                    Instructions
                </h2>

            </div>

            <div class="p-8">

                @if ($this->item->instructions)

                <p class="whitespace-pre-line text-slate-700">
                    {{ $this->item->instructions }}
                </p>

                @else

                <p class="text-slate-400">
                    No instructions provided.
                </p>

                @endif

            </div>

        </div>


        {{-- Metadata --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-8 py-6">

                <h2 class="text-lg font-semibold text-slate-800">
                    Information
                </h2>

            </div>

            <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-2">

                <div>

                    <p class="mb-2 text-sm font-medium text-slate-500">
                        Created At
                    </p>

                    <p class="text-slate-800">
                        {{ $this->item->created_at }}
                    </p>

                </div>


                <div>

                    <p class="mb-2 text-sm font-medium text-slate-500">
                        Updated At
                    </p>

                    <p class="text-slate-800">
                        {{ $this->item->updated_at }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex items-center justify-end gap-4 rounded-2xl border border-slate-200 bg-slate-50 px-8 py-5">

            <a
                href="{{ route('prescriptions.items.index', [
                    'prescription' => $this->item->prescription_id
                ]) }}"
                wire:navigate
                class="rounded-xl border border-slate-300 px-6 py-3 text-slate-700 transition hover:bg-white">

                Back to Items

            </a>

            <a
                href="{{ route('prescriptions.items.edit', [
                    'prescription' => $this->item->prescription_id,
                    'item' => $this->item->id,
                ]) }}"
                wire:navigate
                class="rounded-xl bg-blue-600 px-6 py-3 font-medium text-white transition hover:bg-blue-700">

                Edit Medication

            </a>

        </div>

    </div>

</div>