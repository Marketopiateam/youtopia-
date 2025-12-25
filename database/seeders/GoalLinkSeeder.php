<?php

namespace Database\Seeders;

use App\Models\CompanyGoal;
use App\Models\DepartmentGoal;
use App\Models\GoalLink;
use App\Models\OkrObjective;
use Illuminate\Database\Seeder;

class GoalLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (CompanyGoal::count() === 0) {
            $this->call(CompanyGoalSeeder::class);
        }
        if (DepartmentGoal::count() === 0) {
            $this->call(DepartmentGoalSeeder::class);
        }
        if (OkrObjective::count() === 0) {
            $this->call(OkrObjectiveSeeder::class);
        }

        if (CompanyGoal::count() === 0) {
            CompanyGoal::factory()->count(3)->create();
        }
        if (DepartmentGoal::count() === 0) {
            DepartmentGoal::factory()->count(3)->create();
        }
        if (OkrObjective::count() === 0) {
            OkrObjective::factory()->count(3)->create();
        }

        $companyGoals = CompanyGoal::all();
        $departmentGoals = DepartmentGoal::all();
        $okrObjectives = OkrObjective::all();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $goalType = $faker->randomElement(['company', 'department']);
            $goalId = $goalType === 'company'
                ? $companyGoals->random()->id
                : $departmentGoals->random()->id;

            $objectiveId = $okrObjectives->random()->id;

            GoalLink::firstOrCreate([
                'goal_type' => $goalType,
                'goal_id' => $goalId,
                'objective_id' => $objectiveId,
            ]);
        }

        $this->command->info('Goal Links seeded.');
    }
}
