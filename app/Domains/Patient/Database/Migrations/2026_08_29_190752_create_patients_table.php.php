<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('patient_number', 100)
                ->unique();

            $table->string('name');

            $table->string('phone', 30);

            $table->string('email')
                ->nullable();

            $table->string('gender', 20);

            $table->date('date_of_birth');

            $table->string('national_id', 50)
                ->unique();

            $table->text('address')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->foreignId('created_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
