<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeBankAccount;
use Illuminate\Database\Seeder;

class EmployeeBankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping employee bank account seeding.');
            return;
        }

        foreach ($employees as $employee) {
            EmployeeBankAccount::create([
                'employee_id' => $employee->id,
                'bank_name' => 'The National Bank',
                'account_number' => '1234567890',
                'iban' => 'SA1234567890123456789012',
                'swift_code' => 'TNBKSA',
                'is_primary' => true,
            ]);
        }
    }
}
