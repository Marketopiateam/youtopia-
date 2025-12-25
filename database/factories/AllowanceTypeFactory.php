<?php

namespace Database\Factories;

use App\Models\AllowanceType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllowanceTypeFactory extends Factory
{
    protected $model = AllowanceType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Housing Allowance',
                'Transportation Allowance',
                'Meal Allowance',
                'Medical Allowance',
                'Education Allowance',
                'Relocation Allowance',
                'Remote Work Stipend',
                'Performance Bonus',
                'Travel Allowance',
            ]),
            'code' => strtoupper($this->faker->unique()->bothify('ALW-###')),
            'is_taxable' => $this->faker->boolean(70),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
