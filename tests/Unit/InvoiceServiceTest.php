<?php

namespace Tests\Unit;

use App\Domains\Invoice\Enums\InvoiceStatusEnum;
use App\Domains\Invoice\Exceptions\Invoice\InvalidPaymentAmountException;
use App\Domains\Invoice\Exceptions\Invoice\PaymentAmountExceedsInvoiceTotalException;
use App\Domains\Invoice\Exceptions\Invoice\PaymentAmountExceedsRemainingException;
use App\Domains\Invoice\Services\Invoice\InvoiceService;
use App\Models\Invoice;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public static function invalidPaymentAmountsProvider(): array
    {
        return [
            [0],
            [-1],
            [-500],
        ];
    }
    #[DataProvider('invalidPaymentAmountsProvider')]
    public function test_rejects_invalid_payment_amount(float $paymentAmount): void
    {
        $invoiceService = new InvoiceService();

        $invoice = new Invoice();
        $invoice->total =  10000;
        $invoice->paid_amount =  2000;
        $invoice->remaining_amount =  8000;

        $this->expectException(InvalidPaymentAmountException::class);

        $invoiceService->calculatePaymentImpact($invoice, $paymentAmount);
    }
    public function test_rejects_payment_above_invoice_total(): void
    {
        $invoiceService = new InvoiceService();

        $invoice = new Invoice();
        $invoice->total =  1000;
        $invoice->paid_amount =  500;
        $invoice->remaining_amount =  500;

        $this->expectException(PaymentAmountExceedsInvoiceTotalException::class);

        $invoiceService->calculatePaymentImpact($invoice, 2000);
    }

    public function test_rejects_payment_above_remaining_amount(): void
    {
        $invoiceService = new InvoiceService();

        $invoice = new Invoice();
        $invoice->total =  2000;
        $invoice->paid_amount =  2000;
        $invoice->remaining_amount =  1000;

        $this->expectException(PaymentAmountExceedsRemainingException::class);

        $invoiceService->calculatePaymentImpact($invoice, 2000);
    }
    public function test_calculates_partial_payment_correctly(): void
    {
        $invoiceService = new InvoiceService();

        $invoice = new Invoice();

        $invoice->total = 10000;
        $invoice->paid_amount = 3000;
        $invoice->remaining_amount = 7000;

        $result = $invoiceService->calculatePaymentImpact($invoice, 3000);

        $this->assertSame([
            'paid_amount' => 6000.0,
            'remaining_amount' => 4000.0,
            'status' => InvoiceStatusEnum::PARTIALLY_PAID,
        ], $result);

        // $this->assertSame(6000.0, $result['paid_amount']);
        // $this->assertSame(4000.0, $result['remaining_amount']);
        // $this->assertSame(InvoiceStatusEnum::PARTIALLY_PAID, $result['status']);
    }

    public function test_marks_invoice_as_paid_when_payment_completes_total(): void
    {
        $invoiceService = new InvoiceService();

        $invoice = new Invoice();

        $invoice->total = 10000;
        $invoice->paid_amount = 6000;
        $invoice->remaining_amount = 4000;

        $result = $invoiceService->calculatePaymentImpact($invoice, 4000);

        $this->assertSame(10000.0, $result['paid_amount']);
        $this->assertSame(0.0, $result['remaining_amount']);
        $this->assertSame(InvoiceStatusEnum::PAID, $result['status']);
    }
}
