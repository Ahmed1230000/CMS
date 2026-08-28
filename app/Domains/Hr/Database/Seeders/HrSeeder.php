<?php

namespace App\Domains\Hr\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hr;

class HrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hr::factory()
            ->count(10)
            ->create();
    }
}