<?php

use App\Domains\Invoice\UseCases\ShowInvoiceUseCase\ShowInvoiceUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')]
class extends Component
{
    public string $id;

    private ShowInvoiceUseCase $showInvoiceUseCase;

    public function boot(
        ShowInvoiceUseCase $showInvoiceUseCase
    ): void {
        $this->showInvoiceUseCase = $showInvoiceUseCase;
    }

    public function mount(string $id): void
    {
        $this->id = $id;
    }

    #[Computed]
    public function invoice()
    {
        return $this->showInvoiceUseCase->execute(
            (int) $this->id
        );
    }
};
?>

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Invoice #{{ $this->invoice->invoiceNumber }}
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Invoice details
            </p>
        </div>

        <a
            href="{{ route('invoices.index') }}"
            wire:navigate
            class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Back
        </a>
        <a
            href="{{ route('invoice-items.create', [
        'invoice' => $this->invoice->id,
    ]) }}"
            wire:navigate
            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-indigo-700">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                viewBox="0 0 20 20"
                fill="currentColor">
                <path d="M10 4a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V5a1 1 0 011-1z" />
            </svg>

            View Items
        </a>
    </div>

    {{-- Invoice Information --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Invoice Information
            </h2>

            <div class="space-y-4">

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Invoice Number</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $this->invoice->invoiceNumber }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Patient</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $this->invoice->patientName ?? '—' }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Type</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $this->invoice->type->value }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Status</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $this->invoice->status->value }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Created At</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $this->invoice->createdAt?->format('Y-m-d H:i') }}
                    </span>
                </div>

            </div>

        </div>

        {{-- Financial Summary --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="mb-5 text-lg font-semibold text-gray-900">
                Financial Summary
            </h2>

            <div class="space-y-4">

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Subtotal</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ number_format($this->invoice->subtotal, 2) }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Discount</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ number_format($this->invoice->discount, 2) }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Tax</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ number_format($this->invoice->tax, 2) }}
                    </span>
                </div>

                <div class="border-t border-gray-200 pt-4">

                    <div class="flex justify-between gap-4">
                        <span class="text-sm font-semibold text-gray-900">
                            Total
                        </span>

                        <span class="text-lg font-bold text-gray-900">
                            {{ number_format($this->invoice->total, 2) }}
                        </span>
                    </div>

                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Paid Amount</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ number_format($this->invoice->paidAmount, 2) }}
                    </span>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">Remaining Amount</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ number_format($this->invoice->remainingAmount, 2) }}
                    </span>
                </div>

            </div>

        </div>

    </div>

</div>