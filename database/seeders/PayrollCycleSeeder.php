<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\PayrollCycle;
use Illuminate\Database\Seeder;

class PayrollCycleSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping PayrollCycleSeeder.');
            return;
        }

        PayrollCycle::factory()
            ->count(3)
            ->state(fn () => [
                'processed_by_employee_id' => $employees->random()->id,
            ])
            ->create();
    }
}
