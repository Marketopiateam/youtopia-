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
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping company goal seeding.');
            return;
        }

        CompanyGoal::create([
            'title' => 'Increase Revenue by 20%',
            'description' => 'Focus on new customer acquisition and upselling existing customers.',
            'quarter' => 1,
            'year' => 2026,
            'status' => 'in_progress',
            'owner_employee_id' => $employees->random()->id,
        ]);

        CompanyGoal::create([
            'title' => 'Improve Customer Satisfaction',
            'description' => 'Reduce response times and improve first-contact resolution.',
            'quarter' => 1,
            'year' => 2026,
            'status' => 'in_progress',
            'owner_employee_id' => $employees->random()->id,
        ]);
    }
}
