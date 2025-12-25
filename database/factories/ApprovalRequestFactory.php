<?php

namespace Database\Factories;

use App\Enums\ApprovalStatus;
use App\Models\ApprovalRequest;
use App\Models\ApprovalWorkflow;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApprovalRequestFactory extends Factory
{
    protected $model = ApprovalRequest::class;

    public function definition(): array
    {
        return [
            'workflow_id' => ApprovalWorkflow::factory(),
            'requestable_type' => LeaveRequest::class,
            'requestable_id' => LeaveRequest::factory(),
            'requester_employee_id' => Employee::factory(),
            'current_step' => 1,
            'status' => $this->faker->randomElement(ApprovalStatus::cases()),
            'submitted_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'completed_at' => $this->faker->boolean(50) ? $this->faker->dateTimeBetween('-3 months', 'now') : null,
        ];
    }
}
