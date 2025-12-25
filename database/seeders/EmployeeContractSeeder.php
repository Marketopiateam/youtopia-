<?php

namespace Database\Seeders;

use App\Models\EmployeeContract;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure employees exist
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Create 1-2 contracts per employee
            for ($i = 0; $i < rand(1, 2); $i++) {
                EmployeeContract::factory()->make()->each(function ($contract) use ($employee) {
                    $contract->employee_id = $employee->id;
                    $contract->save();
                });
            }
        }

        $this->command->info('Employee Contracts seeded.');
    }
}