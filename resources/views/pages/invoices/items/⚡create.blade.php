<?php

use App\Domains\Invoice\DTOs\InvoiceItem\InvoiceItemDTO;
use App\Domains\Invoice\DTOs\InvoiceItem\UpdateInvoiceItemDTO;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Invoice\UseCases\IndexInvoiceItemUseCase\IndexInvoiceItemUseCase;
use App\Domains\Invoice\UseCases\InvoiceItem\CreateInvoiceItemUseCase;
use App\Domains\Invoice\UseCases\InvoiceItem\DeleteInvoiceItemUseCase;
use App\Domains\Invoice\UseCases\InvoiceItem\UpdateInvoiceItemUseCase;
use App\Domains\Pharmacy\DTOs\MedicineItem\SearchMedicineItemDTO;
use App\Domains\Pharmacy\UseCases\SearchMedicineItemUseCase\SearchMedicineItemUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')]
class extends Component
{
    public string $invoice;

    public string $search = '';

    public int $quantity = 1;

    public ?int $selectedMedicineItemId = null;

    private SearchMedicineItemUseCase $searchMedicineItemUseCase;

    private CreateInvoiceItemUseCase $createInvoiceItemUseCase;

    private IndexInvoiceItemUseCase $indexInvoiceItemUseCase;

    private UpdateInvoiceItemUseCase $updateInvoiceItemUseCase;

    private InvoiceRepositoryInterface $invoiceRepository;

    private DeleteInvoiceItemUseCase $delete;

    public function boot(
        SearchMedicineItemUseCase $searchMedicineItemUseCase,
        CreateInvoiceItemUseCase $createInvoiceItemUseCase,
        IndexInvoiceItemUseCase $indexInvoiceItemUseCase,
        DeleteInvoiceItemUseCase $deleteInvoiceItemUseCase,
        UpdateInvoiceItemUseCase $updateInvoiceItemUseCase,
        InvoiceRepositoryInterface $invoiceRepository,

    ): void {
        $this->searchMedicineItemUseCase = $searchMedicineItemUseCase;
        $this->createInvoiceItemUseCase = $createInvoiceItemUseCase;
        $this->indexInvoiceItemUseCase = $indexInvoiceItemUseCase;
        $this->updateInvoiceItemUseCase = $updateInvoiceItemUseCase;
        $this->invoiceRepository = $invoiceRepository;
        $this->delete = $deleteInvoiceItemUseCase;
    }

    public function mount(string $invoice): void
    {
        $this->invoice = $invoice;
    }

    #[Computed]
    public function medicineItems()
    {
        if (trim($this->search) === '') {
            return collect();
        }

        return $this->searchMedicineItemUseCase->execute(
            SearchMedicineItemDTO::fromArray([
                'search' => $this->search,
            ])
        );
    }

    public function selectMedicineItem(int $id): void
    {
        $this->selectedMedicineItemId = $id;
    }

    public function addItem(): void
    {
        if (is_null($this->selectedMedicineItemId)) {
            $this->addError(
                'selectedMedicineItemId',
                'Please select a medicine item.'
            );
            return;
        }
        $this->createInvoiceItemUseCase->execute(
            InvoiceItemDTO::fromArray([
                'medicine_item_id' => $this->selectedMedicineItemId,
                'quantity' => $this->quantity,
            ]),
            (int) $this->invoice,
        );

        $this->resetMedicineSearch();
    }

    public function resetMedicineSearch(): void
    {
        $this->search = '';
        $this->selectedMedicineItemId = null;
        $this->quantity = 1;
    }

    #[Computed]
    public function items()
    {
        return $this->indexInvoiceItemUseCase->execute((int) $this->invoice);
    }

    public function updateItem(int $id, int $quantity)
    {
        $invoiceItem = UpdateInvoiceItemDTO::fromArray([
            'quantity' => $quantity,
        ]);

        return  $this->updateInvoiceItemUseCase->execute($id, $invoiceItem);
    }

    #[Computed]
    public function invoiceData()
    {
        return $this->invoiceRepository->find((int) $this->invoice);
    }

    public function deleteItem(int $id)
    {
        $this->delete->execute($id);
    }
};
?>

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Invoice Items
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Add and manage items for this invoice
            </p>
        </div>

        <div class="text-right">
            <p class="text-sm text-gray-500">
                Invoice #
            </p>

            <p class="text-lg font-semibold text-gray-900">
                {{ $this->invoice }}
            </p>
        </div>
    </div>

    {{-- Invoice Summary --}}
    <div class="mb-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-lg font-semibold text-gray-900">
            Invoice Summary
        </h2>

        <div class="grid grid-cols-2 gap-6 md:grid-cols-4">

            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p class="mt-1 font-medium text-gray-900">
                    {{ $this->invoiceData->status->value }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Subtotal</p>
                <p class="mt-1 font-medium text-gray-900">
                    {{ number_format($this->invoiceData->subtotal, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Discount</p>
                <p class="mt-1 font-medium text-gray-900">
                    {{ number_format($this->invoiceData->discount, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tax</p>
                <p class="mt-1 font-medium text-gray-900">
                    {{ number_format($this->invoiceData->tax, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Total</p>
                <p class="mt-1 text-lg font-bold text-gray-900">
                    {{ number_format($this->invoiceData->total, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Paid</p>
                <p class="mt-1 font-medium text-gray-900">
                    {{ number_format($this->invoiceData->paid_amount, 2) }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Remaining</p>
                <p class="mt-1 text-lg font-bold text-gray-900">
                    {{ number_format($this->invoiceData->remaining_amount, 2) }}
                </p>
            </div>

        </div>
    </div>

    {{-- Add Item --}}
    <div class="mb-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

        <h2 class="mb-4 text-lg font-semibold text-gray-900">
            Add Item
        </h2>

        @error('selectedMedicineItemId')
        <p class="mt-1 text-sm text-red-600">
            {{ $message }}
        </p>
        @enderror

        <div class="grid gap-4 md:grid-cols-[1fr_160px_auto]">

            {{-- Medicine Search --}}
            <div class="relative">
                <label class="mb-1 block text-sm font-medium text-gray-700">
                    Medicine
                </label>

                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search medicine by name, code or barcode..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">

                @if (trim($this->search) !== '')
                <div class="absolute z-20 mt-1 max-h-80 w-full overflow-y-auto rounded-lg border border-gray-200 bg-white shadow-lg">

                    @forelse ($this->medicineItems as $medicineItem)

                    <button
                        type="button"
                        wire:click="selectMedicineItem({{ $medicineItem->id }})"
                        class="block w-full border-b border-gray-100 px-4 py-3 text-left hover:bg-gray-50">
                        <div class="flex items-center justify-between">

                            <div>
                                <p class="font-medium text-gray-900">
                                    {{ $medicineItem->medicineItemName ?? $medicineItem->name ?? '' }}
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Code:
                                    {{ $medicineItem->medicineCode ?? $medicineItem->code ?? '' }}
                                </p>
                            </div>

                            <span class="font-semibold text-gray-900">
                                {{ number_format($medicineItem->sellingPrice ?? $medicineItem->selling_price ?? 0, 2) }}
                            </span>

                        </div>
                    </button>

                    @empty

                    <div class="px-4 py-3 text-sm text-gray-500">
                        No medicine found.
                    </div>

                    @endforelse

                </div>
                @endif
            </div>

            {{-- Quantity --}}
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">
                    Quantity
                </label>

                <input
                    type="number"
                    min="1"
                    wire:model="quantity"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Add --}}
            <button
                type="button"
                wire:click="addItem"
                wire:loading.attr="disabled"
                class="w-full rounded-lg bg-indigo-600 px-5 py-2 text-sm font-medium text-white hover:bg-indigo-700 md:w-auto">
                <span wire:loading.remove>
                    Add Item
                </span>

                <span wire:loading>
                    Adding...
                </span>
            </button>

        </div>
    </div>

    {{-- Items Table --}}
    <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-900">
                Invoice Items
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">

                {{-- Header مرة واحدة --}}
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Medicine
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Code
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Quantity
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Unit Price
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Total
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>
                    </tr>
                </thead>

                {{-- Items --}}
                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse ($this->items as $item)

                    <tr class="hover:bg-gray-50">

                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                            {{ $item->medicineItemName }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                            {{ $item->medicineCode }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                            <input
                                type="number"
                                min="1"
                                value="{{ $item->quantity }}"
                                wire:change="updateItem({{ $item->id }}, $event.target.value)"
                                class="w-24 rounded-lg border border-gray-300 px-3 py-2 text-sm">

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                            {{ number_format($item->unitPrice, 2) }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                            {{ number_format($item->total, 2) }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <button
                                type="button"
                                wire:click="deleteItem({{ $item->id }})"
                                class="font-medium text-red-600 hover:text-red-800">
                                Delete
                            </button>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td
                            colspan="6"
                            class="px-6 py-12 text-center text-sm text-gray-500">
                            No items added yet.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-between">

        <a
            href="{{ route('invoices.show', ['id' => $this->invoice]) }}"
            wire:navigate
            class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Back
        </a>

        <button
            type="button"
            class="rounded-lg bg-green-600 px-5 py-2 text-sm font-medium text-white hover:bg-green-700">
            Finish Invoice
        </button>

    </div>

</div>