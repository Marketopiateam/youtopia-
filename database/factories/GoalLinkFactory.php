<?php

namespace Database\Factories;

use App\Models\CompanyGoal;
use App\Models\DepartmentGoal;
use App\Models\GoalLink;
use App\Models\OkrObjective;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoalLinkFactory extends Factory
{
    protected $model = GoalLink::class;

    public function definition(): array
    {
        $goalType = $this->faker->randomElement(['company', 'department']);
        $goalId = $goalType === 'company'
            ? (CompanyGoal::inRandomOrder()->value('id') ?? CompanyGoal::factory()->create()->id)
            : (DepartmentGoal::inRandomOrder()->value('id') ?? DepartmentGoal::factory()->create()->id);

        return [
            'goal_type' => $goalType,
            'goal_id' => $goalId,
            'objective_id' => OkrObjective::inRandomOrder()->value('id') ?? OkrObjective::factory()->create()->id,
        ];
    }
}
