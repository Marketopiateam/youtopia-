<?php

namespace Database\Factories;

use App\Enums\ContractType;
use App\Models\Employee;
use App\Models\EmployeeContract;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeContractFactory extends Factory
{
    protected $model = EmployeeContract::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-5 years', 'now');
        $endDate = $this->faker->boolean(70)
            ? (clone $startDate)->modify('+' . $this->faker->numberBetween(6, 36) . ' months')
            : null;
        $probationEnd = (clone $startDate)->modify('+3 months');

        return [
            'employee_id' => Employee::factory(),
            'contract_type' => $this->faker->randomElement(ContractType::cases()),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate?->format('Y-m-d'),
            'probation_end_date' => $this->faker->boolean(70) ? $probationEnd->format('Y-m-d') : null,
            'working_hours_per_week' => $this->faker->randomFloat(2, 20, 40),
            'base_salary' => $this->faker->randomFloat(2, 30000, 150000),
            'terms' => json_encode(['notice_period_days' => 30, 'benefits' => ['health', 'pension']]),
        ];
    }
}
