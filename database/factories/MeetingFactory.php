<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\Employee;
use App\Enums\MeetingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $scheduledAt = $this->faker->dateTimeBetween('-1 month', '+2 months');
        $durationMinutes = $this->faker->numberBetween(15, 180);

        return [
            'organizer_employee_id' => Employee::factory(),
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph,
            'scheduled_at' => $scheduledAt,
            'duration_minutes' => $durationMinutes,
            'location' => $this->faker->address,
            'status' => $this->faker->randomElement(MeetingStatus::cases()),
            'meeting_link' => $this->faker->boolean(50) ? $this->faker->url : null,
        ];
    }
}
