<?php

use App\Domains\Invoice\UseCases\Invoice\CreateInvoiceUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

new
    #[Layout('layouts.dashboard')]
    class extends Component
    {
        private CreateInvoiceUseCase $createInvoiceUseCase;

        public function boot(CreateInvoiceUseCase $createInvoiceUseCase): void
        {
            $this->createInvoiceUseCase = $createInvoiceUseCase;
        }

        public function createInvoice(): void
        {
            $invoice = $this->createInvoiceUseCase->execute();

            $this->redirect(
                route('invoice-items.create', [
                    'invoice' => $invoice->id,
                ]),
                navigate: true
            );
        }
    };
?>

<div class="p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">
                    Create Direct Invoice
                </h1>

                <p class="mt-2 text-sm text-gray-600">
                    Create a new draft invoice and add items to it.
                </p>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">
                        Invoice Type
                    </span>

                    <span class="font-medium text-gray-900">
                        Direct
                    </span>
                </div>

                <div class="flex items-center justify-between mt-3">
                    <span class="text-sm text-gray-600">
                        Initial Status
                    </span>

                    <span class="font-medium text-gray-900">
                        Draft
                    </span>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a
                    href="{{ route('invoices.index') }}"
                    wire:navigate
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>

                <button
                    type="button"
                    wire:click="createInvoice"
                    wire:loading.attr="disabled"
                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50">
                    <span wire:loading.remove>
                        Create Invoice
                    </span>

                    <span wire:loading>
                        Creating...
                    </span>
                </button>
            </div>

        </div>
    </div>
</div>