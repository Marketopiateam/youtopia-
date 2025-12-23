<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeSocialAccount;
use Illuminate\Database\Seeder;

class EmployeeSocialAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping employee social account seeding.');
            return;
        }

        foreach ($employees as $employee) {
            EmployeeSocialAccount::create([
                'employee_id' => $employee->id,
                'platform' => 'linkedin',
                'url' => 'https://www.linkedin.com/in/' . $employee->user->name,
            ]);
        }
    }
}
