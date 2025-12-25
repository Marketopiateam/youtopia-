<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Meeting;
use App\Models\MeetingActionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingActionItemFactory extends Factory
{
    protected $model = MeetingActionItem::class;

    public function definition(): array
    {
        $dueDate = $this->faker->dateTimeBetween('+1 day', '+3 months');

        return [
            'meeting_id' => Meeting::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->boolean(70) ? $this->faker->sentence : null,
            'assigned_to_employee_id' => Employee::factory(),
            'due_date' => $dueDate->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
        ];
    }
}
