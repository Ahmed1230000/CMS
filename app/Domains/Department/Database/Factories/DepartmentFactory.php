<?php

namespace App\Domains\Department\Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        $departments = [
            [
                'name' => 'Emergency Department',
                'code' => 'ER',
                'description' => 'Provides emergency medical care for acute illnesses and injuries.',
            ],
            [
                'name' => 'Internal Medicine',
                'code' => 'IM',
                'description' => 'Provides diagnosis and treatment of adult medical conditions.',
            ],
            [
                'name' => 'General Surgery',
                'code' => 'SURG',
                'description' => 'Provides surgical treatment for a wide range of conditions.',
            ],
            [
                'name' => 'Cardiology',
                'code' => 'CARD',
                'description' => 'Specializes in diagnosis and treatment of cardiovascular conditions.',
            ],
            [
                'name' => 'Pediatrics',
                'code' => 'PED',
                'description' => 'Provides medical care for infants, children, and adolescents.',
            ],
            [
                'name' => 'Obstetrics and Gynecology',
                'code' => 'OBGYN',
                'description' => 'Provides pregnancy, childbirth, and women’s healthcare services.',
            ],
            [
                'name' => 'Orthopedics',
                'code' => 'ORTH',
                'description' => 'Provides diagnosis and treatment of musculoskeletal conditions.',
            ],
            [
                'name' => 'Neurology',
                'code' => 'NEURO',
                'description' => 'Provides diagnosis and treatment of nervous system disorders.',
            ],
            [
                'name' => 'Radiology',
                'code' => 'RAD',
                'description' => 'Provides diagnostic imaging services.',
            ],
            [
                'name' => 'Laboratory',
                'code' => 'LAB',
                'description' => 'Provides laboratory testing and diagnostic analysis.',
            ],
            [
                'name' => 'Intensive Care Unit',
                'code' => 'ICU',
                'description' => 'Provides intensive monitoring and treatment for critically ill patients.',
            ],
        ];


        $department = fake()->unique()->randomElement($departments);
        $user = User::findOrFail(1);
        return [
            'name' => $department['name'],
            'code' => $department['code'],
            'description' => $department['description'],
            'is_active' => true,
            'created_by' => $user->id
        ];
    }
}
