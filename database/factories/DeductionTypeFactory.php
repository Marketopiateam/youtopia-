<?php

namespace Database\Factories;

use App\Models\DeductionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeductionTypeFactory extends Factory
{
    protected $model = DeductionType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Income Tax',
                'Social Security',
                'Health Insurance',
                'Retirement Plan',
                'Loan Repayment',
                'Union Dues',
                'Charitable Contribution',
                'Advanced Salary',
                'Other Deductions',
            ]),
            'code' => strtoupper($this->faker->unique()->bothify('DED-###')),
            'is_mandatory' => $this->faker->boolean(50),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
