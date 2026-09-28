<?php

namespace App\Domains\Prescription\Database\Factories;

use App\Domains\Prescription\Enums\PrescriptionStatusEnum;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Prescription;
use App\Models\User;

class PrescriptionFactory extends Factory
{
    protected $model = Prescription::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'doctor_id' => Doctor::factory(),
            'appointment_id' => Appointment::factory(),

            'status' => PrescriptionStatusEnum::ACTIVE,

            'created_by' => User::factory(),
        ];
    }
}
