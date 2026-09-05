<?php

use App\Domains\MedicalRecord\Enums\MedicalRecordStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            // TODO: columns
            $table->id();
            $table->foreignId('patient_id')->constrained()->restrictOnDelete();

            $table->text('chief_complaint')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('clinical_notes')->nullable();
            $table->text('treatment_plan')->nullable();

            $table->enum('status', [
                array_column(MedicalRecordStatusEnum::cases(), 'value'),
            ])->default(MedicalRecordStatusEnum::DRAFT->value);

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
