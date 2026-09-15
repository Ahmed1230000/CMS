<?php

use App\Domains\Pharmacy\UseCases\ShowMedicineItemUseCase\ShowMedicineItemUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    protected ShowMedicineItemUseCase $showMedicineItemUseCase;

    public string $medicine;
    public string $id;

    public function boot(
        ShowMedicineItemUseCase $showMedicineItemUseCase
    ): void {
        $this->showMedicineItemUseCase = $showMedicineItemUseCase;
    }
    public function mount(string $medicine, string $id): void
    {
        $this->medicine = $medicine;
        $this->id = $id;
    }

    #[Computed]
    public function medicineItem()
    {
        return $this->showMedicineItemUseCase->execute($this->id);
    }
};

?>

<div>

    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Medicine Item Details
            </h1>

            <p class="mt-2 text-slate-500">
                View medicine item information.
            </p>
        </div>

        <div class="flex items-center gap-2">

            <a
                href="{{ route('medicine-items.index', ['medicine' => $this->medicine,'id' => $this->medicineItem->id]) }}"
                wire:navigate
                class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-200">
                Back
            </a>

            <a
                href="{{ route('medicine-items.update',  ['medicine' => $this->medicine,'id' => $this->medicineItem->id]) }}"
                wire:navigate
                class="rounded-lg bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700 transition hover:bg-blue-200">
                Update
            </a>

        </div>

    </div>


    {{-- Medicine Item Information --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- ID --}}
            <div>
                <p class="text-sm text-slate-500">
                    ID
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $this->medicineItem->id }}
                </p>
            </div>


            {{-- Parent Medicine --}}
            <div>
                <p class="text-sm text-slate-500">
                    Medicine
                </p>

                <a
                    href="{{ route('medicines.show', $this->medicineItem->medicine_id) }}"
                    wire:navigate
                    class="mt-1 inline-block font-medium text-blue-600 transition hover:underline">
                    {{ $this->medicineItem->medicine_name }}
                </a>
            </div>


            {{-- Medicine Code --}}
            <div>
                <p class="text-sm text-slate-500">
                    Medicine Code
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $this->medicineItem->medicine_code ?: '—' }}
                </p>
            </div>


            {{-- Medicine Generic Name --}}
            <div>
                <p class="text-sm text-slate-500">
                    Medicine Generic Name
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->medicine_generic_name ?: '—' }}
                </p>
            </div>


            {{-- Medicine Manufacturer --}}
            <div>
                <p class="text-sm text-slate-500">
                    Medicine Manufacturer
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->medicine_manufacturer ?: '—' }}
                </p>
            </div>


            {{-- Item Code --}}
            <div>
                <p class="text-sm text-slate-500">
                    Item Code
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $this->medicineItem->code }}
                </p>
            </div>


            {{-- Item Name --}}
            <div>
                <p class="text-sm text-slate-500">
                    Item Name
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->name }}
                </p>
            </div>


            {{-- Strength --}}
            <div>
                <p class="text-sm text-slate-500">
                    Strength
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->strength ?: '—' }}
                </p>
            </div>


            {{-- Dosage Form --}}
            <div>
                <p class="text-sm text-slate-500">
                    Dosage Form
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->dosage_form ?: '—' }}
                </p>
            </div>


            {{-- Unit --}}
            <div>
                <p class="text-sm text-slate-500">
                    Unit
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->unit ?: '—' }}
                </p>
            </div>


            {{-- Barcode --}}
            <div>
                <p class="text-sm text-slate-500">
                    Barcode
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->barcode ?: '—' }}
                </p>
            </div>

            {{-- Selling Price --}}
            <div>
                <p class="text-sm text-slate-500">
                    Selling Price
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->selling_price }}
                </p>
            </div>


            {{-- Status --}}
            <div>
                <p class="text-sm text-slate-500">
                    Status
                </p>

                <div class="mt-2">

                    @if ($this->medicineItem->status?->value === 'active')

                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                        Active
                    </span>

                    @elseif ($this->medicineItem->status?->value === 'inactive')

                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">
                        Inactive
                    </span>

                    @endif

                </div>
            </div>


            {{-- Created By --}}
            <div>
                <p class="text-sm text-slate-500">
                    Created By
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->created_by_name ?: '—' }}
                </p>
            </div>


            {{-- Created At --}}
            <div>
                <p class="text-sm text-slate-500">
                    Created At
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->created_at }}
                </p>
            </div>


            {{-- Updated At --}}
            <div>
                <p class="text-sm text-slate-500">
                    Updated At
                </p>

                <p class="mt-1 text-slate-700">
                    {{ $this->medicineItem->updated_at }}
                </p>
            </div>

        </div>

    </div>

</div>