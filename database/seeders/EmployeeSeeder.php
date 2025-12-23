<?php

namespace Database\Seeders;

use App\Enums\EmployeeStatus;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $departments = Department::all();

        if ($departments->isEmpty()) {
            $this->command->warn('No departments found, skipping EmployeeSeeder.');
            return;
        }

        DB::transaction(function () use ($departments) {
            // Get all non-admin users
            $usersToBecomeEmployees = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            if ($usersToBecomeEmployees->isEmpty()) {
                $this->command->warn('No non-admin users found to create employees for.');
                return;
            }

            $managerEmployees = Employee::whereHas('user.roles', function($query) {
                $query->where('name', 'manager');
            })->get();

            $lastEmployeeNumber = (int) (Employee::withTrashed()->max('employee_number') ?? 0);

            foreach ($usersToBecomeEmployees as $index => $user) {
                // Check if employee already exists for this user
                if ($user->employee) {
                    continue;
                }

                $employeeNumber = $lastEmployeeNumber + 1 + $index;
                $department = $departments->random();
                $hireDate = now()->subDays(rand(30, 500))->toDateString();

                $managerEmployeeId = null;
                if ($managerEmployees->isNotEmpty()) {
                    $managerEmployeeId = $managerEmployees->random()->id;
                }

                Employee::create([
                    'user_id' => $user->id,
                    'employee_number' => $employeeNumber,
                    'employee_code'   => 'EMP-' . str_pad((string) $employeeNumber, 6, '0', STR_PAD_LEFT),
                    'status' => EmployeeStatus::Active->value,
                    'hire_date' => $hireDate,
                    'department_id' => $department->id,
                    'manager_employee_id' => $managerEmployeeId,
                ]);
            }

            $this->command->info('Created employee records for non-admin users successfully.');
        });
    }
}