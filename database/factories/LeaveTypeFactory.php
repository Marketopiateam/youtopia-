<?php

namespace Database\Factories;

use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveTypeFactory extends Factory
{
    protected $model = LeaveType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Annual Leave',
                'Sick Leave',
                'Maternity Leave',
                'Paternity Leave',
                'Bereavement Leave',
                'Unpaid Leave',
                'Casual Leave',
            ]),
            'code' => strtoupper($this->faker->unique()->bothify('LT-###')),
            'days_per_year' => $this->faker->numberBetween(5, 30),
            'is_paid' => $this->faker->boolean(80),
            'requires_approval' => $this->faker->boolean(90),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
