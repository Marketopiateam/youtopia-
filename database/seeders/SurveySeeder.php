<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping SurveySeeder.');
            return;
        }

        Survey::factory()
            ->count(5)
            ->state(fn () => [
                'created_by_employee_id' => $employees->random()->id,
            ])
            ->create();
    }
}
