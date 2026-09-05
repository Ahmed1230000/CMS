<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();


            $table->string('license_number', 100)
                ->unique();

            $table->string('specialization');

            $table->string('phone', 30);

            $table->string('email');

            $table->text('bio')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->foreignId('user_id')->nullable()
                ->unique()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('department_id')
                ->constrained('departments')->restrictOnDelete();

            $table->foreignId('created_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
