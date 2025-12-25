<?php

namespace Database\Factories;

use App\Models\ApprovalWorkflow;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApprovalWorkflowFactory extends Factory
{
    protected $model = ApprovalWorkflow::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'entity_type' => $this->faker->randomElement([
                'leave_request',
                'expense_report',
                'purchase_order',
                'onboarding',
                'promotion',
                'document_review',
                'travel_request',
            ]),
            'department_id' => null,
            'description' => $this->faker->sentence,
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
