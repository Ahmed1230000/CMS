<?php

use App\Domains\Prescription\Enums\PrescriptionItemStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prescription_id')
                ->constrained('prescriptions')
                ->cascadeOnDelete();

            $table->string('medication_name');

            $table->string('dosage');

            $table->string('frequency');

            $table->string('duration');

            $table->text('instructions')->nullable();

            $table->enum('status', array_column(PrescriptionItemStatusEnum::cases(), 'value'))->default(PrescriptionItemStatusEnum::ACTIVE->value);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};
