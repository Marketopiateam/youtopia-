<?php

namespace Database\Seeders;

use App\Models\EmployeeProfile;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeProfileSeeder extends Seeder
{
    public function run(): void
    {
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        $employees = Employee::all();

        foreach ($employees as $employee) {
            EmployeeProfile::firstOrCreate(
                ['employee_id' => $employee->id],
                EmployeeProfile::factory()
                    ->make(['employee_id' => $employee->id])
                    ->toArray()
            );
        }

        $this->command->info('Employee Profiles seeded.');
    }
}
