<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\DepartmentGoal;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DepartmentGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();
        $employees = Employee::all();

        if ($departments->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No departments or employees found, skipping department goal seeding.');
            return;
        }

        DepartmentGoal::create([
            'department_id' => $departments->random()->id,
            'title' => 'Launch new marketing campaign',
            'description' => 'Focus on social media and content marketing.',
            'quarter' => 1,
            'year' => 2026,
            'status' => 'in_progress',
            'owner_employee_id' => $employees->random()->id,
        ]);

        DepartmentGoal::create([
            'department_id' => $departments->random()->id,
            'title' => 'Redesign the main website',
            'description' => 'Improve user experience and mobile responsiveness.',
            'quarter' => 1,
            'year' => 2026,
            'status' => 'in_progress',
            'owner_employee_id' => $employees->random()->id,
        ]);
    }
}
