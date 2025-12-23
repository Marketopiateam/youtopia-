<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\PayrollCycle;
use Illuminate\Database\Seeder;

class PayrollCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping payroll cycle seeding.');
            return;
        }

        PayrollCycle::create([
            'year' => 2025,
            'month' => 11,
            'start_date' => '2025-11-01',
            'end_date' => '2025-11-30',
            'status' => 'completed',
            'processed_at' => now()->subDays(10),
            'processed_by_employee_id' => $employees->random()->id,
        ]);

        PayrollCycle::create([
            'year' => 2025,
            'month' => 12,
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-31',
            'status' => 'processing',
            'processed_by_employee_id' => $employees->random()->id,
        ]);
    }
}
