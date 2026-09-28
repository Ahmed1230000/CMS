<?php

namespace App\Domains\Patient\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\User;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition(): array
    {
        return [
            'patient_number' => fake()->unique()->numerify('PAT-#####'),
            'name' => fake()->name(),
            'phone' => fake()->unique()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'gender' => 'male',
            'date_of_birth' => fake()->date(),
            'national_id' => fake()->unique()->numerify('##############'),
            'address' => fake()->address(),
            'is_active' => true,

            'created_by' => User::factory(),
            'user_id' => null,
        ];
    }
}
