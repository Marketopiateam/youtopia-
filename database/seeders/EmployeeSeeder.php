<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        if (Department::count() === 0) {
            $this->call(DepartmentSeeder::class);
        }

        $departments = Department::all();

        $nextEmployeeNumber = (int) (Employee::withTrashed()->max('employee_number') ?? 1000);

        $nextEmployeeAttributes = function () use (&$nextEmployeeNumber): array {
            $nextEmployeeNumber++;
            $employeeNumber = $nextEmployeeNumber;

            return [
                'employee_number' => $employeeNumber,
                'employee_code' => 'EMP-' . str_pad((string) $employeeNumber, 6, '0', STR_PAD_LEFT),
            ];
        };

        $managerUsers = User::role('manager')->get();
        foreach ($managerUsers as $managerUser) {
            if ($managerUser->employee) {
                continue;
            }

            Employee::factory()->create([
                ...$nextEmployeeAttributes(),
                'user_id' => $managerUser->id,
                'department_id' => $departments->random()->id,
                'manager_employee_id' => null,
            ]);
        }

        $managerEmployees = Employee::whereIn('user_id', $managerUsers->pluck('id'))->get();

        $usersWithoutEmployees = User::whereDoesntHave('employee')->get();
        foreach ($usersWithoutEmployees as $user) {
            Employee::factory()->create([
                ...$nextEmployeeAttributes(),
                'user_id' => $user->id,
                'department_id' => $departments->random()->id,
                'manager_employee_id' => $managerEmployees->isNotEmpty()
                    ? $managerEmployees->random()->id
                    : null,
            ]);
        }

        $this->command->info('Employees seeded.');
    }
}
