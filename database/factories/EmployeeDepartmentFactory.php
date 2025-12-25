<?php

namespace Database\Factories;

use App\Models\EmployeeDepartment;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeDepartmentFactory extends Factory
{
    protected $model = EmployeeDepartment::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-5 years', 'now');
        $endDate = $this->faker->boolean(30)
            ? (clone $startDate)->modify('+' . $this->faker->numberBetween(3, 24) . ' months')
            : null;

        return [
            'employee_id' => Employee::factory(),
            'department_id' => Department::factory(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate?->format('Y-m-d'),
        ];
    }
}
