<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\PerformanceReview;
use App\Models\PerformanceReviewTemplate;
use Illuminate\Database\Seeder;

class PerformanceReviewSeeder extends Seeder
{
    public function run(): void
    {
        $templates = PerformanceReviewTemplate::all();
        $employees = Employee::all();

        if ($templates->isEmpty() || $employees->count() < 2) {
            $this->command->info('No templates or insufficient employees found, skipping PerformanceReviewSeeder.');
            return;
        }

        foreach ($employees->take(5) as $employee) {
            $reviewer = $employees->where('id', '!=', $employee->id)->random();

            PerformanceReview::factory()->create([
                'template_id' => $templates->random()->id,
                'employee_id' => $employee->id,
                'reviewer_employee_id' => $reviewer->id,
            ]);
        }
    }
}
