<?php

use App\Domains\Pharmacy\UseCases\IndexMedicineItemUseCase\IndexMedicineItemUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected IndexMedicineItemUseCase $indexMedicineItemUseCase;

    public int $medicine;

    public function boot(
        IndexMedicineItemUseCase $indexMedicineItemUseCase
    ): void {
        $this->indexMedicineItemUseCase = $indexMedicineItemUseCase;
    }

    public function mount(int $medicine): void
    {
        $this->medicine = $medicine;
    }

    #[Computed]
    public function medicineItems()
    {
        return $this->indexMedicineItemUseCase->execute(
            $this->medicine
        );
    }
};
?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Medicine Items
            </h1>

            <p class="mt-2 text-slate-500">
                Manage medicine items.
            </p>
        </div>

        <a
            href="{{ route('medicine-items.create', [
                'medicine' => $this->medicine,
            ]) }}"
            wire:navigate
            class="inline-flex items-center rounded-xl bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700">
            + Create Medicine Item
        </a>
    </div>


    {{-- Medicine Items Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                {{-- Table Header --}}
                <thead class="border-b bg-slate-50">

                    <tr>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            #ID
                        </th>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Medicine
                        </th>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Code
                        </th>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Name
                        </th>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Strength
                        </th>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Dosage Form
                        </th>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Unit
                        </th>
                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Selling Price
                        </th>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Status
                        </th>

                        <th class="whitespace-nowrap px-6 py-4 text-left text-sm font-semibold text-slate-700">
                            Actions
                        </th>

                    </tr>

                </thead>


                {{-- Table Body --}}
                <tbody>

                    @forelse ($this->medicineItems as $medicineItem)

                    <tr class="border-b last:border-b-0 hover:bg-slate-50">

                        {{-- ID --}}
                        <td class="whitespace-nowrap px-6 py-4 text-slate-700">
                            {{ $medicineItem->id }}
                        </td>


                        {{-- Medicine --}}
                        <td class="whitespace-nowrap px-6 py-4">

                            <a
                                href="{{ route('medicines.show', $medicineItem->medicine_id) }}"
                                wire:navigate
                                class="font-medium text-blue-600 transition hover:underline">
                                {{ $medicineItem->medicine_name }}
                            </a>

                        </td>


                        {{-- Code --}}
                        <td class="max-w-[220px] px-6 py-4 text-slate-600">

                            <span
                                title="{{ $medicineItem->code }}"
                                class="block truncate">
                                {{ $medicineItem->code }}
                            </span>

                        </td>


                        {{-- Name --}}
                        <td class="max-w-[220px] px-6 py-4 text-slate-600">

                            <span
                                title="{{ $medicineItem->name }}"
                                class="block truncate">
                                {{ $medicineItem->name }}
                            </span>

                        </td>


                        {{-- Strength --}}
                        <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                            {{ $medicineItem->strength ?: '—' }}
                        </td>


                        {{-- Dosage Form --}}
                        <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                            {{ $medicineItem->dosage_form ?: '—' }}
                        </td>


                        {{-- Unit --}}
                        <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                            {{ $medicineItem->unit ?: '—' }}
                        </td>
                        {{-- Unit --}}
                        <td class="whitespace-nowrap px-6 py-4 text-slate-600">
                            {{ $medicineItem->selling_price }}
                        </td>


                        {{-- Status --}}
                        <td class="whitespace-nowrap px-6 py-4">

                            @if ($medicineItem->status?->value === 'active')

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                Active
                            </span>

                            @elseif ($medicineItem->status?->value === 'inactive')

                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                                Inactive
                            </span>

                            @endif

                        </td>


                        {{-- Actions --}}
                        <td class="whitespace-nowrap px-6 py-4">

                            <div class="flex items-center gap-2">

                                {{-- View --}}
                                <a
                                    href="{{ route('medicine-items.show', [
                                            'medicine' => $this->medicine,
                                            'id' => $medicineItem->id,
                                        ]) }}"
                                    wire:navigate
                                    class="rounded-lg bg-slate-100 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
                                    View
                                </a>


                                {{-- Update --}}
                                <a
                                    href="{{ route('medicine-items.update', [
                                            'medicine' => $this->medicine,
                                            'id' => $medicineItem->id,
                                        ]) }}"
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
                            colspan="9"
                            class="px-6 py-12 text-center text-slate-500">
                            No medicine items found.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    <div class="mt-6">
        {{ $this->medicineItems->links() }}
    </div>

</div>