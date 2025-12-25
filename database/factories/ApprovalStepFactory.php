<?php

namespace Database\Factories;

use App\Enums\ApprovalApproverType;
use App\Models\ApprovalStep;
use App\Models\ApprovalWorkflow;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApprovalStepFactory extends Factory
{
    protected $model = ApprovalStep::class;

    public function definition(): array
    {
        $approverType = $this->faker->randomElement(ApprovalApproverType::cases());
        $approverRole = null;
        $approverEmployeeId = null;

        if ($approverType === ApprovalApproverType::Role) {
            $approverRole = $this->faker->randomElement(['manager', 'hr', 'admin']);
        } elseif ($approverType === ApprovalApproverType::Employee) {
            $approverEmployeeId = Employee::inRandomOrder()->value('id');
        }

        return [
            'workflow_id' => ApprovalWorkflow::factory(),
            'step_order' => $this->faker->numberBetween(1, 5),
            'approver_type' => $approverType,
            'approver_role' => $approverRole,
            'approver_employee_id' => $approverEmployeeId,
            'is_required' => $this->faker->boolean(80),
        ];
    }
}
