<?php

namespace App\Domains\Pharmacy\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicineItem;

class MedicineItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicineItem::factory()
            ->count(10)
            ->create();
    }
}