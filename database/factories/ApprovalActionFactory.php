<?php

namespace Database\Factories;

use App\Enums\ApprovalActionType;
use App\Models\ApprovalAction;
use App\Models\ApprovalRequest;
use App\Models\ApprovalStep;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApprovalActionFactory extends Factory
{
    protected $model = ApprovalAction::class;

    public function definition(): array
    {
        return [
            'approval_request_id' => ApprovalRequest::factory(),
            'step_id' => ApprovalStep::factory(),
            'approver_employee_id' => Employee::factory(),
            'action' => $this->faker->randomElement(ApprovalActionType::cases()),
            'notes' => $this->faker->boolean(70) ? $this->faker->paragraph : null,
            'acted_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
