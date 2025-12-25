<?php

namespace Database\Factories;

use App\Enums\PayrollCycleStatus;
use App\Models\Employee;
use App\Models\PayrollCycle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PayrollCycle>
 */
class PayrollCycleFactory extends Factory
{
    protected $model = PayrollCycle::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-2 months', 'now');
        $end = (clone $start)->modify('+1 month');

        return [
            'year' => (int) $start->format('Y'),
            'month' => (int) $start->format('m'),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'status' => PayrollCycleStatus::Open,
            'processed_at' => null,
            'processed_by_employee_id' => Employee::factory(),
        ];
    }
}
