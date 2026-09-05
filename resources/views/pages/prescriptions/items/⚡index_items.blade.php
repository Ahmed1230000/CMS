<?php

use App\Domains\Prescription\DTOs\PrescriptionItem\IndexPrescriptionItemDTO;
use App\Domains\Prescription\UseCases\IndexPrescriptionItemUseCase\IndexPrescriptionItemUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected IndexPrescriptionItemUseCase $indexPrescriptionItemUseCase;

    public int $prescription_id;

    public function boot(
        IndexPrescriptionItemUseCase $indexPrescriptionItemUseCase
    ): void {
        $this->indexPrescriptionItemUseCase = $indexPrescriptionItemUseCase;
    }

    public function mount(string $prescription): void
    {
        $this->prescription_id = (int) $prescription;
    }

    #[Computed]
    public function items()
    {
        return $this->indexPrescriptionItemUseCase->execute(
            $this->prescription_id
        );
    }
};
?>

<div class="p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Prescription Items
            </h1>

            <p class="text-sm text-gray-500">
                Prescription #{{ $prescription_id }}
            </p>
        </div>

        <a
            href="{{ route('prescriptions.items.create', $prescription_id) }}"
            wire:navigate
            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Add Medication
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">
                        Medication
                    </th>

                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">
                        Dosage
                    </th>

                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">
                        Frequency
                    </th>

                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">
                        Duration
                    </th>

                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">
                        Status
                    </th>

                    <th class="px-6 py-3 text-sm font-semibold text-gray-600">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($this->items as $item)
                <tr>
                    <td class="px-6 py-4">
                        {{ $item->medication_name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->dosage }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->frequency }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->duration }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->status }}
                    </td>

                    <td class="px-6 py-4">
                        <a
                            href="{{ route('prescriptions.items.show', [
                                    'prescription' => $prescription_id,
                                    'item' => $item->id,
                                ]) }}"
                            wire:navigate
                            class="text-blue-600 hover:underline">
                            View
                        </a>

                        <a
                            href="{{ route('prescriptions.items.edit', [
                                    'prescription' => $prescription_id,
                                    'item' => $item->id,
                                ]) }}"
                            wire:navigate
                            class="ml-3 text-green-600 hover:underline">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td
                        colspan="6"
                        class="px-6 py-8 text-center text-gray-500">
                        No prescription items found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $this->items->links() }}
    </div>

</div>