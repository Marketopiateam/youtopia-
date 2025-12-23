<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\JobPost;
use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();
        $employees = Employee::all();

        if ($departments->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No departments or employees found, skipping job post seeding.');
            return;
        }

        JobPost::create([
            'title' => 'Senior Software Engineer',
            'description' => 'We are looking for a skilled software engineer to join our team.',
            'requirements' => '5+ years of experience, strong knowledge of Laravel, Vue.js',
            'department_id' => $departments->random()->id,
            'created_by_employee_id' => $employees->random()->id,
            'status' => 'published',
            'published_at' => now(),
            'expires_at' => now()->addDays(30),
        ]);

        JobPost::create([
            'title' => 'HR Specialist',
            'description' => 'Manage HR operations and support employee relations.',
            'requirements' => '3+ years of HR experience, excellent communication skills',
            'department_id' => $departments->random()->id,
            'created_by_employee_id' => $employees->random()->id,
            'status' => 'published',
            'published_at' => now(),
            'expires_at' => now()->addDays(45),
        ]);
    }
}
