<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()
                ->unique()
                ->constrained('users')->nullOnDelete();

            $table->string('employee_number', 100)
                ->unique();

            $table->string('name');

            $table->string('phone', 30);

            $table->string('email');

            $table->string('gender', 20);

            $table->date('date_of_birth');

            $table->string('national_id', 50)
                ->unique();

            $table->text('address')
                ->nullable();

            $table->date('hire_date');

            $table->string('job_title');

            $table->boolean('is_active')
                ->default(true);

            $table->foreignId('created_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
