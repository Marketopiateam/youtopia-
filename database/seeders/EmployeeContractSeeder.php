<?php

namespace Database\Seeders;

use App\Enums\ContractType;
use App\Models\Employee;
use App\Models\EmployeeContract;
use Illuminate\Database\Seeder;

class EmployeeContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping employee contract seeding.');
            return;
        }

        foreach ($employees as $employee) {
            EmployeeContract::create([
                'employee_id' => $employee->id,
                'contract_type' => ContractType::FULL_TIME,
                'start_date' => $employee->hire_date,
                'working_hours_per_week' => 40,
                'base_salary' => 50000,
            ]);
        }
    }
}
