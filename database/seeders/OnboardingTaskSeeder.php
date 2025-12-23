<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\OnboardingTask;
use Illuminate\Database\Seeder;

class OnboardingTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping onboarding task seeding.');
            return;
        }

        foreach ($employees as $employee) {
            OnboardingTask::create([
                'employee_id' => $employee->id,
                'title' => 'Complete HR Paperwork',
                'description' => 'Fill out all necessary HR forms and submit them.',
                'assigned_by_employee_id' => $employees->random()->id,
                'due_date' => now()->addDays(7),
                'status' => 'pending',
            ]);

            OnboardingTask::create([
                'employee_id' => $employee->id,
                'title' => 'Setup Development Environment',
                'description' => 'Install all required software and tools for your role.',
                'assigned_by_employee_id' => $employees->random()->id,
                'due_date' => now()->addDays(14),
                'status' => 'in_progress',
            ]);
        }
    }
}
