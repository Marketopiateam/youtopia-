<?php

namespace Database\Factories;

use App\Models\PerformanceReviewTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PerformanceReviewTemplate>
 */
class PerformanceReviewTemplateFactory extends Factory
{
    protected $model = PerformanceReviewTemplate::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
