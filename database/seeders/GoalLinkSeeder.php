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
        $companyGoals = CompanyGoal::all();
        $departmentGoals = DepartmentGoal::all();
        $objectives = OkrObjective::all();

        if ($companyGoals->isNotEmpty() && $objectives->isNotEmpty()) {
            GoalLink::create([
                'goal_type' => 'company',
                'goal_id' => $companyGoals->random()->id,
                'objective_id' => $objectives->random()->id,
            ]);
        }

        if ($departmentGoals->isNotEmpty() && $objectives->isNotEmpty()) {
            GoalLink::create([
                'goal_type' => 'department',
                'goal_id' => $departmentGoals->random()->id,
                'objective_id' => $objectives->random()->id,
            ]);
        }
    }
}
