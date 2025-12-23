<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\PayrollCycle;
use App\Models\Payslip;
use Illuminate\Database\Seeder;

class PayslipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payrollCycles = PayrollCycle::all();
        $employees = Employee::all();

        if ($payrollCycles->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No payroll cycles or employees found, skipping payslip seeding.');
            return;
        }

        foreach ($payrollCycles as $cycle) {
            foreach ($employees as $employee) {
                $basicSalary = $employee->employeeContracts->first()->base_salary ?? 50000;
                $totalEarnings = $basicSalary + rand(1000, 5000);
                $totalDeductions = rand(5000, 10000);
                $netSalary = $totalEarnings - $totalDeductions;

                Payslip::create([
                    'payroll_cycle_id' => $cycle->id,
                    'employee_id' => $employee->id,
                    'basic_salary' => $basicSalary,
                    'total_earnings' => $totalEarnings,
                    'total_deductions' => $totalDeductions,
                    'net_salary' => $netSalary,
                    'generated_at' => now(),
                ]);
            }
        }
    }
}
