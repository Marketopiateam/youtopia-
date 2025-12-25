<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\PayrollCycle;
use App\Models\Payslip;
use Illuminate\Database\Seeder;

class PayslipSeeder extends Seeder
{
    public function run(): void
    {
        $payrollCycles = PayrollCycle::all();
        $employees = Employee::all();

        if ($payrollCycles->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No payroll cycles or employees found, skipping PayslipSeeder.');
            return;
        }

        foreach ($payrollCycles as $cycle) {
            $sampleEmployees = $employees->count() > 5
                ? $employees->random(5)
                : $employees;

            foreach ($sampleEmployees as $employee) {
                Payslip::factory()->create([
                    'payroll_cycle_id' => $cycle->id,
                    'employee_id' => $employee->id,
                ]);
            }
        }
    }
}
