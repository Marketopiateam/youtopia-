<?php

namespace Database\Factories;

use App\Enums\InterviewStatus;
use App\Models\Interview;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterviewFactory extends Factory
{
    protected $model = Interview::class;

    public function definition(): array
    {
        $scheduledAt = $this->faker->dateTimeBetween('+1 day', '+2 months');

        return [
            'application_id' => JobApplication::factory(),
            'scheduled_at' => $scheduledAt,
            'location' => $this->faker->randomElement(['HQ', 'Zoom', 'Teams']),
            'interview_type' => $this->faker->randomElement(['in_person', 'phone', 'video']),
            'status' => $this->faker->randomElement(InterviewStatus::cases()),
            'notes' => $this->faker->boolean(60) ? $this->faker->paragraph : null,
        ];
    }
}
