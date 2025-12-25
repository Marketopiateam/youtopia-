<?php

namespace Database\Factories;

use App\Enums\LeaveStatus;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveRequestFactory extends Factory
{
    protected $model = LeaveRequest::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = (clone $startDate)->modify('+' . $this->faker->numberBetween(1, 5) . ' days');
        $submittedAt = (clone $startDate)->modify('-' . $this->faker->numberBetween(1, 5) . ' days');
        $status = $this->faker->randomElement(LeaveStatus::cases());

        return [
            'employee_id' => Employee::factory(),
            'leave_type_id' => LeaveType::factory(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'days_count' => $startDate->diff($endDate)->days + 1,
            'reason' => $this->faker->sentence,
            'status' => $status,
            'submitted_at' => $submittedAt,
        ];
    }
}
