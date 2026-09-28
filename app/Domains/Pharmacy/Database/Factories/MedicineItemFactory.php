<?php

namespace App\Domains\Pharmacy\Database\Factories;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MedicineItem;
use App\Models\User;

class MedicineItemFactory extends Factory
{
    protected $model = MedicineItem::class;

    public function definition(): array
    {
        return [
            'medicine_id' => Medicine::factory(),
            'code' => fake()->unique()->numerify('MED-ITEM-######'),
            'name' => fake()->words(2, true),
            'strength' => fake()->randomElement([
                '100mg',
                '250mg',
                '500mg',
                '10mg',
                '20mg',
            ]),
            'dosage_form' => fake()->randomElement([
                'Tablet',
                'Capsule',
                'Syrup',
                'Injection',
                'Cream',
            ]),
            'unit' => fake()->randomElement([
                'box',
                'strip',
                'bottle',
                'piece',
            ]),
            'barcode' => fake()->unique()->numerify('############'),
            'status' => MedicineStatusEnum::ACTIVE,
            'created_by' => User::factory(),
            'selling_price' => fake()->randomFloat(2, 10, 1000),
        ];
    }
}
