<?php

use App\Domains\Appointment\Enums\AppointmentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('doctor_id')
                ->constrained('doctors')->restrictOnDelete();

            $table->foreignId('patient_id')
                ->constrained('patients')->restrictOnDelete();

            $table->foreignId('department_id')
                ->constrained('departments')->restrictOnDelete();

            $table->date('appointment_date');

            $table->time('start_time');

            $table->time('end_time');

            $table->enum('status', array_column(AppointmentStatusEnum::cases(), 'value'))
                ->default(AppointmentStatusEnum::SCHEDULED->value);

            $table->string('reason')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->foreignId('created_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
