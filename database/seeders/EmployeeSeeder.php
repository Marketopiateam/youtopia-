<?php

namespace Database\Seeders;

use App\Enums\EmployeeStatus;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // نتأكد إن في Departments
        $departments = Department::all();

        if ($departments->isEmpty()) {
            $this->command->warn('No departments found, skipping EmployeeSeeder.');
            return;
        }

        DB::transaction(function () use ($departments) {

            // الحصول على جميع المدراء
            $managerUsers = \App\Models\User::whereHas('roles', function($query) {
                $query->where('name', 'manager');
            })->get();

            $managerEmployees = $managerUsers->map(function($user) {
                return $user->employee;
            })->filter();

            if ($managerEmployees->isEmpty()) {
                $this->command->warn('No manager employees found, skipping EmployeeSeeder.');
                return;
            }

            // آخر رقم موظف
            $lastEmployeeNumber = (int) (Employee::withTrashed()->max('employee_number') ?? 0);

            // إنشاء 20 موظف وتوزيعهم على الـ5 مدراء (4 موظفين لكل مدير)
            for ($i = 1; $i <= 20; $i++) {

                $employeeNumber = $lastEmployeeNumber + $i;
                $department = $departments->random();

                // توزيع الموظف على مدير (كل 4 موظفين لمدير واحد)
                $managerIndex = ceil($i / 4) - 1; // 0, 0, 0, 0, 1, 1, 1, 1, ...
                $managerEmployee = $managerEmployees->get($managerIndex);

                // إنشاء الموظف
                $employee = Employee::create([
                    'employee_number' => $employeeNumber,
                    'employee_code'   => 'EMP-' . str_pad((string) $employeeNumber, 6, '0', STR_PAD_LEFT),

                    'status' => EmployeeStatus::Active->value,
                    'hire_date' => now()->subDays(rand(30, 500))->toDateString(),

                    'department_id' => $department->id,
                    'manager_employee_id' => $managerEmployee?->id,
                ]);

                // إنشاء البروفايل
                EmployeeProfile::create([
                    'employee_id' => $employee->id,
                    'first_name'  => fake()->firstName(),
                    'last_name'   => fake()->lastName(),
                    'phone'       => fake()->phoneNumber(),
                    'email'       => fake()->safeEmail(),
                    'birth_date'  => fake()->date('Y-m-d', '-22 years'),
                    'address'     => fake()->address(),
                ]);
            }

            $this->command->info("Created 20 employees distributed across {$managerEmployees->count()} managers");
        });
    }
}
