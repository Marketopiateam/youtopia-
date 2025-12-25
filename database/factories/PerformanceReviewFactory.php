<?php

namespace Database\Factories;

use App\Enums\ReviewStatus;
use App\Models\Employee;
use App\Models\PerformanceReview;
use App\Models\PerformanceReviewTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PerformanceReview>
 */
class PerformanceReviewFactory extends Factory
{
    protected $model = PerformanceReview::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-6 months', '-2 months');
        $end = (clone $start)->modify('+3 months');

        return [
            'template_id' => PerformanceReviewTemplate::factory(),
            'employee_id' => Employee::factory(),
            'reviewer_employee_id' => Employee::factory(),
            'review_period_start' => $start->format('Y-m-d'),
            'review_period_end' => $end->format('Y-m-d'),
            'overall_rating' => $this->faker->randomFloat(2, 2, 5),
            'summary' => $this->faker->sentence(),
            'status' => ReviewStatus::Draft,
            'submitted_at' => null,
        ];
    }
}
