<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\DepartmentGoal;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentGoalFactory extends Factory
{
    protected $model = DepartmentGoal::class;

    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph,
            'quarter' => $this->faker->numberBetween(1, 4),
            'year' => (int) $this->faker->year(),
            'status' => $this->faker->randomElement(['draft', 'active', 'completed', 'cancelled']),
            'owner_employee_id' => Employee::factory(),
        ];
    }
}
