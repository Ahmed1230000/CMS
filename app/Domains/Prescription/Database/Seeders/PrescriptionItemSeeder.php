<?php

namespace App\Domains\Prescription\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrescriptionItem;

class PrescriptionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrescriptionItem::factory()
            ->count(10)
            ->create();
    }
}