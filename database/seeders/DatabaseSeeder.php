<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domains\Authorization\Database\Seeders\PermissionSeeder;
use App\Domains\Authorization\Database\Seeders\RolesSeeder;
use App\Domains\User\Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            
    UserSeeder::class,
            RolesSeeder::class,
            PermissionSeeder::class,
        ]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            UserSeeder::class,
            RolesSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
