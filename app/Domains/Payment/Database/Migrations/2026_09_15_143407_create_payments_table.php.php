<?php

use App\Domains\Payment\Enums\PaymentMethodEnum;
use App\Domains\Payment\Enums\PaymentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            // TODO: columns
            $table->id();
            $table->foreignId('invoice_id')
                ->constrained()
                ->restrictOnDelete();

            $table->enum('method', array_column(
                PaymentMethodEnum::cases(),
                'value'
            ))->default(PaymentMethodEnum::CASH->value);

            $table->decimal('amount', 12, 2);

            $table->enum('status', array_column(
                PaymentStatusEnum::cases(),
                'value'
            ))->default(PaymentStatusEnum::PENDING->value);

            $table->string('transaction_id')->nullable()->unique();
            
            $table->foreignId('created_by')->constrained('users','id')->restrictOnDelete();

            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
