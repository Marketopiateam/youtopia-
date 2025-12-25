<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\MeetingAgendaItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingAgendaItemFactory extends Factory
{
    protected $model = MeetingAgendaItem::class;

    public function definition(): array
    {
        return [
            'meeting_id' => Meeting::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->boolean(70) ? $this->faker->paragraph : null,
            'order' => $this->faker->numberBetween(1, 10),
            'duration_minutes' => $this->faker->numberBetween(10, 60),
        ];
    }
}
