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
        if (Department::count() === 0) {
            $this->call(DepartmentSeeder::class);
        }
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        $departments = Department::all();
        $employees = Employee::all();

        foreach ($departments as $department) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                DepartmentGoal::factory()->make()->each(function ($departmentGoal) use ($department, $employees) {
                    $departmentGoal->department_id = $department->id;
                    $departmentGoal->owner_employee_id = $employees->random()->id;
                    $departmentGoal->save();
                });
            }
        }

        $this->command->info('Department Goals seeded.');
    }
}
