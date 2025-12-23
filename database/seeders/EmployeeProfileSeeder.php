<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeProfile;
use Illuminate\Database\Seeder;

class EmployeeProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping employee profile seeding.');
            return;
        }

        foreach ($employees as $employee) {
            EmployeeProfile::create([
                'employee_id' => $employee->id,
                'first_name' => $employee->user->name,
                'last_name' => 'Faker',
                'phone' => '123456789',
                'email' => $employee->user->email,
            ]);
        }
    }
}
