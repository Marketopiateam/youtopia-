<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\PerformanceReview;
use App\Models\PerformanceReviewTemplate;
use Illuminate\Database\Seeder;

class PerformanceReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = PerformanceReviewTemplate::all();
        $employees = Employee::all();

        if ($templates->isEmpty() || $employees->count() < 2) {
            $this->command->info('No templates or insufficient employees found, skipping performance review seeding.');
            return;
        }

        foreach ($employees as $employee) {
            $reviewer = $employees->where('id', '!=', $employee->id)->random();

            PerformanceReview::create([
                'template_id' => $templates->random()->id,
                'employee_id' => $employee->id,
                'reviewer_employee_id' => $reviewer->id,
                'review_period_start' => now()->subMonths(6)->toDateString(),
                'review_period_end' => now()->subDay()->toDateString(),
                'overall_rating' => rand(30, 50) / 10,
                'summary' => 'Employee has shown consistent growth and dedication. Areas for improvement include time management.',
                'status' => 'completed',
                'submitted_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
