<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;

class UserSeeder extends Seeder
{
    private function createUserWithEmployee(
        int $index,
        string $role,
        string $email,
        string $name,
        string $panel,
        int $departmentId = 1,
        ?int $managerEmployeeId = null
    ): void {
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => 'password',
                'default_panel' => $panel,
            ]
        );
        $user->assignRole($role);

        // Get the next available employee number
        $lastEmployeeNumber = (int) (Employee::withTrashed()->max('employee_number') ?? 0);
        $employeeNumber = $lastEmployeeNumber + 1;

        $employee = Employee::firstOrCreate(
            ['user_id' => $user->id],
            [
                'employee_number' => $employeeNumber,
                'employee_code'   => 'EMP-' . str_pad((string) $employeeNumber, 6, '0', STR_PAD_LEFT),
                'department_id' => $departmentId,
            ]
        );

        if ($managerEmployeeId && ! $employee->manager_employee_id) {
            $employee->update(['manager_employee_id' => $managerEmployeeId]);
        }
    }

    public function run(): void
    {
        // Admin (without employee record)
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
                'default_panel' => 'admin',
            ]
        )->assignRole('admin');

        // 5 HR Users
        for ($i = 1; $i <= 5; $i++) {
            $this->createUserWithEmployee(
                $i, 'hr', "hr{$i}@demo.com", "HR User {$i}", 'hr'
            );
        }

        // 5 Manager Users
        for ($i = 1; $i <= 5; $i++) {
            $this->createUserWithEmployee(
                $i, 'manager', "manager{$i}@demo.com", "Manager User {$i}", 'manager'
            );
        }

        $managerEmployeeIds = User::query()
            ->whereHas('roles', fn($query) => $query->where('name', 'manager'))
            ->with('employee:id,user_id')
            ->get()
            ->pluck('employee.id')
            ->filter()
            ->values();

        // 20 Employee Users
        for ($i = 1; $i <= 20; $i++) {
            $managerEmployeeId = $managerEmployeeIds->isNotEmpty()
                ? $managerEmployeeIds[($i - 1) % $managerEmployeeIds->count()]
                : null;

            $this->createUserWithEmployee(
                $i,
                'employee',
                "employee{$i}@demo.com",
                "Employee User {$i}",
                'employee',
                1,
                $managerEmployeeId
            );
        }

        $this->command->info('Created users with employee records successfully');
    }
}
