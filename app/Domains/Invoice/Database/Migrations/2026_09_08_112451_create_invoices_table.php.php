<?php

use App\Domains\Invoice\Enums\InvoiceStatusEnum;
use App\Domains\Invoice\Enums\InvoiceTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            // TODO: columns
            $table->id();
            $table->string('invoice_number')->unique();

            $table->foreignId('patient_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('prescription_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete();

            $table->enum('type', array_column(InvoiceTypeEnum::cases(), 'value'))->default(InvoiceTypeEnum::DIRECT->value);
            $table->enum('status', array_column(InvoiceStatusEnum::cases(), 'value'))->default(InvoiceStatusEnum::DRAFT->value);

            $table->decimal('subtotal', 12, 2);

            $table->decimal('discount', 12, 2)->default(0);

            $table->decimal('tax', 12, 2)->default(0);

            $table->decimal('total', 12, 2);

            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('remaining_amount', 12, 2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
