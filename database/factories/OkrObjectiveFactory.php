<?php

namespace Database\Factories;

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
use App\Models\Department;
use App\Models\Employee;
use App\Models\OkrCycle;
use App\Models\OkrObjective;
use Illuminate\Database\Eloquent\Factories\Factory;

class OkrObjectiveFactory extends Factory
{
    protected $model = OkrObjective::class;

    public function definition(): array
    {
        $scope = $this->faker->randomElement(OKRScope::cases());
        $scopeId = null;

        if ($scope === OKRScope::Department) {
            $scopeId = Department::factory();
        } elseif ($scope === OKRScope::Employee) {
            $scopeId = Employee::factory();
        }

        return [
            'cycle_id' => OkrCycle::factory(),
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph,
            'scope' => $scope,
            'scope_id' => $scopeId,
            'owner_employee_id' => Employee::factory(),
            'parent_objective_id' => null,
            'progress_percentage' => $this->faker->randomFloat(2, 0, 100),
            'status' => $this->faker->randomElement(OKRStatus::cases()),
        ];
    }
}
