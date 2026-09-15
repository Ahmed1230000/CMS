<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            // TODO: columns
            $table->id();
            $table->foreignId('invoice_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('medicine_item_id')
                ->constrained()
                ->restrictOnDelete();

            $table->unsignedInteger('quantity');

            $table->decimal('unit_price', 12, 2);

            $table->decimal('total', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoiceitems');
    }
};
