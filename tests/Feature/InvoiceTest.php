<?php

namespace Tests\Feature;

use App\Domains\Invoice\Entities\Invoice\InvoiceEntity;
use App\Domains\Invoice\Enums\InvoiceStatusEnum;
use App\Domains\Invoice\Mapper\InvoiceMapper;
use App\Domains\Invoice\Repositories\Eloquent\Invoice\InvoiceEloquentRepository;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_finds_invoice_by_id(): void
    {
        $invoice = Invoice::factory()->create();

        $invoiceRepo = new InvoiceEloquentRepository();

        $result = $invoiceRepo->find($invoice->id);

        $this->assertNotNull($result);
        $this->assertSame($invoice->id, $result->id);
    }

    public function  test_throws_exception_when_invoice_does_not_exist(): void
    {
        $invoiceRepo = new InvoiceEloquentRepository();
        $this->expectException(ModelNotFoundException::class);
        $invoiceRepo->find(99999999);
    }

    public function test_creates_invoice_successfully(): void
    {
        $entity = InvoiceEntity::create();

        $invoiceRepo = new InvoiceEloquentRepository();

        $result = $invoiceRepo->create($entity);

        $this->assertNotNull($result->id);

        $this->assertDatabaseHas('invoices', [
            'id' => $result->id,
            'invoice_number' => $entity->invoiceNumber,
            'type' => $entity->type->value,
            'status' => $entity->status->value,
            'subtotal' => $entity->subtotal,
            'discount' => $entity->discount,
            'tax' => $entity->tax,
            'total' => $entity->total,
            'paid_amount' => $entity->paidAmount,
            'remaining_amount' => $entity->remainingAmount,
        ]);
    }

    public function test_finds_invoice_as_entity(): void
    {
        $invoice = Invoice::factory()->create();

        $invoiceRepo = new InvoiceEloquentRepository();

        $result = $invoiceRepo->findByEntity($invoice->id);

        $this->assertInstanceOf(InvoiceEntity::class, $result);

        $this->assertSame($invoice->id, $result->id);
        $this->assertSame($invoice->invoice_number, $result->invoiceNumber);
        $this->assertSame($invoice->patient_id, $result->patientId);
        $this->assertSame($invoice->prescription_id, $result->prescriptionId);
        $this->assertSame($invoice->type, $result->type);
        $this->assertSame($invoice->status, $result->status);
        $this->assertSame((float) $invoice->total, $result->total);
    }

    public function test_returns_true_when_invoice_has_items(): void
    {
        $invoice = Invoice::factory()->create();

        InvoiceItem::factory()->create([
            'invoice_id' => $invoice->id
        ]);

        $invoiceRepo = new InvoiceEloquentRepository();

        $result = $invoiceRepo->hasItems($invoice->id);

        $this->assertTrue($result);
    }

    public function test_returns_false_when_invoice_has_no_items(): void
    {
        $invoice = Invoice::factory()->create();

        $invoiceRepo = new InvoiceEloquentRepository();

        $result = $invoiceRepo->hasItems($invoice->id);

        $this->assertFalse($result);
    }

    public function test_inserts_invoice_number_successfully(): void
    {
        $invoice = Invoice::factory()->create([
            'invoice_number' => 'IN',
        ]);

        $invoiceRepo = new InvoiceEloquentRepository();

        $entity = InvoiceMapper::toEntity($invoice);

        $result = $invoiceRepo->insertInvoiceNumber($entity);

        $expectedInvoiceNumber = 'IN-' . $invoice->id;

        $this->assertEquals($expectedInvoiceNumber, $result->invoiceNumber);

        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'invoice_number' => $expectedInvoiceNumber,
        ]);
    }

    public function test_updates_invoice_totals_successfully(): void
    {
        $invoice = Invoice::factory()->create([
            'subtotal' => 1000,
            'discount' => 100,
            'tax' => 90,
            'total' => 990,
            'remaining_amount' => 990,
        ]);

        $invoiceRepo = new InvoiceEloquentRepository();

        $result = $invoiceRepo->updateTotals($invoice->id, [
            'subtotal' => 2000,
            'discount' => 200,
            'tax' => 180,
            'total' => 1980,
            'remaining_amount' => 1980,
        ]);

        $this->assertSame($invoice->id, $result->id);

        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'subtotal' => 2000,
            'discount' => 200,
            'tax' => 180,
            'total' => 1980,
            'remaining_amount' => 1980,
        ]);
    }

    public function test_updates_invoice_payment_state_successfully(): void
    {
        $invoice = Invoice::factory()->create([
            'paid_amount' => 0,
            'remaining_amount' => 1000,
            'status' => InvoiceStatusEnum::UNPAID,
        ]);

        $repository = new InvoiceEloquentRepository();

        $repository->updatePaymentState($invoice->id, [
            'paid_amount' => 500,
            'remaining_amount' => 500,
            'status' => InvoiceStatusEnum::PARTIALLY_PAID,
        ]);

        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'paid_amount' => 500,
            'remaining_amount' => 500,
            'status' => InvoiceStatusEnum::PARTIALLY_PAID->value,
        ]);
    }

    public function test_finds_invoice_for_update(): void
    {
        $invoice = Invoice::factory()->create();

        $repository = new InvoiceEloquentRepository();

        $result = $repository->findForUpdate($invoice->id);

        $this->assertNotNull($result);

        $this->assertSame($invoice->id, $result->id);
    }
}
