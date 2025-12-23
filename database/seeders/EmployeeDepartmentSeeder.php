<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeDepartment;
use Illuminate\Database\Seeder;

class EmployeeDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();
        $departments = Department::all();

        if ($employees->isEmpty() || $departments->isEmpty()) {
            $this->command->info('No employees or departments found, skipping employee department seeding.');
            return;
        }

        foreach ($employees as $employee) {
            EmployeeDepartment::create([
                'employee_id' => $employee->id,
                'department_id' => $departments->random()->id,
                'start_date' => $employee->hire_date,
            ]);
        }
    }
}
