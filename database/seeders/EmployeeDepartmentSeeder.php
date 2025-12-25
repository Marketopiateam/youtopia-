<?php

namespace Database\Seeders;

use App\Models\EmployeeDepartment;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Seeder;

class EmployeeDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure employees and departments exist
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }
        if (Department::count() === 0) {
            $this->call(DepartmentSeeder::class);
        }

        $employees = Employee::all();
        $departments = Department::all();

        foreach ($employees as $employee) {
            // Assign employee to a random department
            $department = $departments->random();

            EmployeeDepartment::firstOrCreate(
                [
                    'employee_id' => $employee->id,
                    'department_id' => $department->id,
                ],
                [
                    'start_date' => $employee->hire_date,
                    'end_date' => null,
                ]
            );
        }

        $this->command->info('Employee-Department relationships seeded.');
    }
}
