<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Meeting;
use App\Models\MeetingAttendee;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingAttendeeFactory extends Factory
{
    protected $model = MeetingAttendee::class;

    public function definition(): array
    {
        return [
            'meeting_id' => Meeting::factory(),
            'employee_id' => Employee::factory(),
            'attendance_status' => $this->faker->randomElement(['invited', 'accepted', 'declined', 'attended', 'absent']),
        ];
    }
}
