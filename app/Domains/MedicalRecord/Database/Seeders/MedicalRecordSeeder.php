<?php

namespace App\Domains\MedicalRecord\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalRecord;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalRecord::factory()
            ->count(10)
            ->create();
    }
}