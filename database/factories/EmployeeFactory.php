<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use App\Models\Department;
use App\Enums\EmployeeStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        static $employeeNumber = null;
        if ($employeeNumber === null) {
            $employeeNumber = (int) (Employee::withTrashed()->max('employee_number') ?? 1000);
        }
        $employeeNumber++;

        return [
            'user_id' => User::factory(),
            'department_id' => Department::factory(),
            'manager_employee_id' => null,
            'employee_number' => $employeeNumber,
            'employee_code' => 'EMP-' . str_pad((string) $employeeNumber, 6, '0', STR_PAD_LEFT),
            'status' => EmployeeStatus::Active,
            'hire_date' => $this->faker->dateTimeBetween('-2 years', '-1 month')->format('Y-m-d'),
            'termination_date' => null,
        ];
    }
}
