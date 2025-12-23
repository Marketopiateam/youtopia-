<?php

namespace Database\Seeders;

use App\Models\ApprovalStep;
use App\Models\ApprovalWorkflow;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class ApprovalStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveWorkflow = ApprovalWorkflow::where('entity_type', 'leave_request')->first();
        $ticketWorkflow = ApprovalWorkflow::where('entity_type', 'ticket')->first();
        $employees = Employee::all();

        if ($leaveWorkflow && $employees->isNotEmpty()) {
            ApprovalStep::create([
                'workflow_id' => $leaveWorkflow->id,
                'step_order' => 1,
                'approver_role' => 'manager',
                'is_required' => true,
            ]);

            ApprovalStep::create([
                'workflow_id' => $leaveWorkflow->id,
                'step_order' => 2,
                'approver_role' => 'hr',
                'is_required' => true,
            ]);
        }

        if ($ticketWorkflow && $employees->isNotEmpty()) {
            ApprovalStep::create([
                'workflow_id' => $ticketWorkflow->id,
                'step_order' => 1,
                'approver_employee_id' => $employees->random()->id,
                'is_required' => true,
            ]);
        }
    }
}
