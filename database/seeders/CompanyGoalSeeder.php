<?php

namespace Database\Seeders;

use App\Models\CompanyGoal;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class CompanyGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        $employees = Employee::all();

        CompanyGoal::factory()->count(10)->make()->each(function ($goal) use ($employees) {
            $goal->owner_employee_id = $employees->random()->id;
            $goal->save();
        });

        $this->command->info('Company Goals seeded.');
    }
}
