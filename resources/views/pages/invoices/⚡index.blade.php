<?php

use App\Domains\Invoice\UseCases\IndexInvoiceUseCase\IndexInvoiceUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')]
class extends Component
{
    private IndexInvoiceUseCase $indexInvoiceUseCase;

    public function boot(
        IndexInvoiceUseCase $indexInvoiceUseCase
    ): void {
        $this->indexInvoiceUseCase = $indexInvoiceUseCase;
    }

    #[Computed]
    public function invoices()
    {
        return $this->indexInvoiceUseCase->execute();
    }
};
?>

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Invoices
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage hospital invoices
            </p>
        </div>

        <a
            href="{{ route('invoices.create') }}"
            wire:navigate
            class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            + Create Invoice
        </a>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Invoice #
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Patient
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Type
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Status
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Total
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Paid
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Remaining
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Created At
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Actions
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse ($this->invoices as $invoice)
                    <tr class="hover:bg-gray-50">

                        <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-900">
                            {{ $invoice->invoiceNumber }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                            {{ $invoice->patientName ?? '—' }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                            {{ $invoice->type->value }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                            {{ $invoice->status->value }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                            {{ number_format($invoice->total, 2) }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                            {{ number_format($invoice->paidAmount, 2) }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">
                            {{ number_format($invoice->remainingAmount, 2) }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ $invoice->createdAt?->format('Y-m-d H:i') }}
                        </td>

                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">

                            <a
                                href="{{ route('invoices.show', ['id' => $invoice->id]) }}"
                                wire:navigate
                                class="font-medium text-indigo-600 hover:text-indigo-800">
                                View
                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td
                            colspan="9"
                            class="px-6 py-12 text-center text-sm text-gray-500">
                            No invoices found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="border-t border-gray-200 px-6 py-4">
            {{ $this->invoices->links() }}
        </div>

    </div>

</div>