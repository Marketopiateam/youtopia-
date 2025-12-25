<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\PayrollCycle;
use App\Models\Payslip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payslip>
 */
class PayslipFactory extends Factory
{
    protected $model = Payslip::class;

    public function definition(): array
    {
        $basic = $this->faker->randomFloat(2, 1000, 5000);
        $earnings = $basic + $this->faker->randomFloat(2, 100, 800);
        $deductions = $this->faker->randomFloat(2, 50, 300);

        return [
            'payroll_cycle_id' => PayrollCycle::factory(),
            'employee_id' => Employee::factory(),
            'basic_salary' => $basic,
            'total_earnings' => $earnings,
            'total_deductions' => $deductions,
            'net_salary' => $earnings - $deductions,
            'currency_code' => 'USD',
            'generated_at' => now(),
        ];
    }
}
