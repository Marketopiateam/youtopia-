<?php

namespace Database\Factories;

use App\Models\CompanyGoal;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyGoalFactory extends Factory
{
    protected $model = CompanyGoal::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'quarter' => $this->faker->numberBetween(1, 4),
            'year' => (int) $this->faker->year(),
            'status' => $this->faker->randomElement(['draft', 'active', 'completed', 'cancelled']),
            'owner_employee_id' => Employee::factory(),
        ];
    }
}
