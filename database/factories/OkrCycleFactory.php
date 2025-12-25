<?php

namespace Database\Factories;

use App\Enums\OKRStatus;
use App\Models\OkrCycle;
use Illuminate\Database\Eloquent\Factories\Factory;

class OkrCycleFactory extends Factory
{
    protected $model = OkrCycle::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-2 years', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, $startDate->format('Y-m-d') . ' +6 months');

        return [
            'name' => $this->faker->words(2, true) . ' OKR Cycle ' . $startDate->format('Y'),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'status' => $this->faker->randomElement(OKRStatus::cases()),
            'description' => $this->faker->paragraph,
        ];
    }
}
