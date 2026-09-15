<?php

use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Payment\DTOs\Payment\PaymentDTO;
use App\Domains\Payment\Enums\PaymentMethodEnum;
use App\Domains\Payment\UseCases\Payment\CreatePaymentUseCase;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    public string $invoice;

    public string $method = 'cash';

    public float $amount = 0;

    private InvoiceRepositoryInterface $invoiceRepository;

    private CreatePaymentUseCase $createPaymentUseCase;

    public function boot(
        InvoiceRepositoryInterface $invoiceRepository,
        CreatePaymentUseCase $createPaymentUseCase,
    ): void {
        $this->invoiceRepository = $invoiceRepository;
        $this->createPaymentUseCase = $createPaymentUseCase;
    }

    public function mount(string $invoice): void
    {
        $this->invoice = $invoice;
    }

    #[Computed]
    public function invoiceData()
    {
        return $this->invoiceRepository->find(
            (int) $this->invoice
        );
    }

    public function pay(): void
    {
        try {
            $this->createPaymentUseCase->execute(
                (int) $this->invoice,
                PaymentDTO::fromArray([
                    'method' => PaymentMethodEnum::CASH,
                    'amount' => $this->amount,
                ]),
            );

            $this->redirect(
                route('invoices.show', [
                    'id' => $this->invoice,
                ]),
                navigate: true
            );
        } catch (\Throwable $e) {
            $this->addError(
                'payment',
                $e->getMessage()
            );
        }
    }
};
?>

<div class="mx-auto max-w-3xl p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Make Payment
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Invoice #{{ $this->invoiceData->invoice_number }}
        </p>
    </div>

    {{-- Payment Card --}}
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

        {{-- Invoice Summary --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

            <div class="rounded-lg bg-gray-50 p-4">
                <p class="text-sm text-gray-500">
                    Total
                </p>

                <p class="mt-1 text-lg font-bold text-gray-900">
                    {{ number_format($this->invoiceData->total, 2) }}
                </p>
            </div>

            <div class="rounded-lg bg-gray-50 p-4">
                <p class="text-sm text-gray-500">
                    Paid
                </p>

                <p class="mt-1 text-lg font-bold text-gray-900">
                    {{ number_format($this->invoiceData->paid_amount, 2) }}
                </p>
            </div>

            <div class="rounded-lg bg-gray-50 p-4">
                <p class="text-sm text-gray-500">
                    Remaining
                </p>

                <p class="mt-1 text-lg font-bold text-gray-900">
                    {{ number_format($this->invoiceData->remaining_amount, 2) }}
                </p>
            </div>

        </div>

        {{-- Payment Method --}}
        <div class="mb-5">

            <label class="mb-1 block text-sm font-medium text-gray-700">
                Payment Method
            </label>

            <div class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3">
                <span class="text-sm font-medium text-gray-800">
                    Cash
                </span>
            </div>

        </div>

        {{-- Amount --}}
        <div class="mb-6">

            <label class="mb-1 block text-sm font-medium text-gray-700">
                Amount
            </label>

            <input
                type="number"
                min="0.01"
                step="0.01"
                wire:model="amount"
                placeholder="Enter payment amount"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">

            @error('payment')
            <p class="mt-2 text-sm text-red-600">
                {{ $message }}
            </p>
            @enderror

        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between">

            <a
                href="{{ route('invoices.show', ['id' => $this->invoice]) }}"
                wire:navigate
                class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                Cancel
            </a>

            <button
                type="button"
                wire:click="pay"
                wire:loading.attr="disabled"
                class="rounded-lg bg-green-600 px-5 py-2 text-sm font-medium text-white hover:bg-green-700">
                Pay
            </button>

        </div>

    </div>

</div>