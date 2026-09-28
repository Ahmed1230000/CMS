<?php

namespace App\Domains\Doctor\Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use App\Models\User;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'department_id' => Department::factory(),

            'license_number' => fake()->unique()->numerify('DOC-######'),
            'specialization' => fake()->randomElement([
                'Cardiology',
                'Dermatology',
                'Neurology',
                'Pediatrics',
                'Orthopedics',
                'General Medicine',
            ]),
            'phone' => fake()->unique()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'bio' => fake()->paragraph(),
            'is_active' => true,

            'created_by' => User::factory(),
        ];
    }
}
