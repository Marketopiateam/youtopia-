<?php

namespace Database\Factories;

use App\Enums\AudienceType;
use App\Enums\SurveyStatus;
use App\Models\Employee;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    protected $model = Survey::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $end = (clone $start)->modify('+2 weeks');

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'created_by_employee_id' => Employee::factory(),
            'audience_type' => AudienceType::Company,
            'audience_id' => null,
            'starts_at' => $start,
            'ends_at' => $end,
            'is_anonymous' => $this->faker->boolean(30),
            'status' => SurveyStatus::Draft,
        ];
    }
}
