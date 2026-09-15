<?php

namespace App\Domains\Pharmacy\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicine::factory()
            ->count(10)
            ->create();
    }
}