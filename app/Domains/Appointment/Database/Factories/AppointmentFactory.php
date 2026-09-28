<?php

namespace App\Domains\Appointment\Database\Factories;

use App\Domains\Appointment\Enums\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        $startTime = fake()->dateTimeBetween('08:00', '16:00');
        $endTime = (clone $startTime)->modify('+30 minutes');

        return [
            'doctor_id' => Doctor::factory(),
            'patient_id' => Patient::factory(),
            'department_id' => Department::factory(),

            'appointment_date' => fake()->dateTimeBetween('today', '+30 days'),

            'start_time' => $startTime,
            'end_time' => $endTime,

            'status' => AppointmentStatusEnum::SCHEDULED,

            'reason' => fake()->sentence(),
            'notes' => fake()->optional()->paragraph(),

            'created_by' => User::factory(),
        ];
    }
}
