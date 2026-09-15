<?php

use App\Domains\PHarmacy\Enums\MedicineItemStatusEnum;
use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicine_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('medicine_id')
                ->constrained('medicines', 'id')
                ->restrictOnDelete();

            $table->string('code')->unique();

            $table->string('name');

            $table->string('strength')->nullable();

            $table->string('dosage_form')->nullable();

            $table->string('unit')->nullable();

            $table->string('barcode')->unique()->nullable();

            $table->decimal('selling_price', 12, 2);

            $table->enum(
                'status',
                array_column(MedicineStatusEnum::cases(), 'value')
            )->default(MedicineStatusEnum::ACTIVE->value);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicine_items');
    }
};
