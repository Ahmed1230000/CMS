<?php

namespace App\Domains\pharmacy\Database\Factories;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Medicine;
use App\Models\User;

class MedicineFactory extends Factory
{
    protected $model = Medicine::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->numerify('MED-######'),
            'name' => fake()->words(2, true),
            'generic_name' => fake()->words(2, true),
            'manufacturer' => fake()->company(),

            'status' => MedicineStatusEnum::ACTIVE,

            'created_by' => User::factory(),
        ];
    }
}
