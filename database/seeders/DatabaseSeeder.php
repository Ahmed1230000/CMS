<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Domains\Appointment\Database\Seeders\AppointmentSeeder;
use App\Domains\Patient\Database\Seeders\PatientSeeder;
use App\Domains\Employee\Database\Seeders\EmployeeSeeder;
use App\Domains\Doctor\Database\Seeders\DoctorSeeder;
use App\Domains\Hr\Database\Seeders\HrSeeder;
use App\Domains\Department\Database\Seeders\DepartmentSeeder;
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
            RoleAndPermissionSeeder::class,
            DepartmentSeeder::class,
            HrSeeder::class,
            DoctorSeeder::class,
            EmployeeSeeder::class,
            PatientSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
}
