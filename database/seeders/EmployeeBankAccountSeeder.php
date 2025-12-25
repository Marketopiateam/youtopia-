<?php

namespace Database\Seeders;

use App\Models\EmployeeBankAccount;
use App\Models\Employee;

use Illuminate\Database\Seeder;

class EmployeeBankAccountSeeder extends Seeder
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
            // Create 1-2 bank accounts per employee
            for ($i = 0; $i < rand(1, 2); $i++) {
                EmployeeBankAccount::factory()->make()->each(function ($bankAccount) use ($employee, $i) {
                    $bankAccount->employee_id = $employee->id;
                    $bankAccount->is_primary = ($i === 0); // First account is primary
                    $bankAccount->save();
                });
            }
        }

        $this->command->info('Employee Bank Accounts seeded.');
    }
}
