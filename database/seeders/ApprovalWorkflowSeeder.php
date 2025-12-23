<?php

namespace Database\Seeders;

use App\Models\ApprovalWorkflow;
use App\Models\Department;
use Illuminate\Database\Seeder;

class ApprovalWorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = Department::first();

        ApprovalWorkflow::create([
            'name' => 'Leave Request Approval',
            'entity_type' => 'leave_request',
            'department_id' => $department?->id,
            'description' => 'Default workflow for leave requests.',
            'is_active' => true,
        ]);

        ApprovalWorkflow::create([
            'name' => 'Ticket Escalation Workflow',
            'entity_type' => 'ticket',
            'department_id' => $department?->id,
            'description' => 'Default workflow for escalating tickets.',
            'is_active' => true,
        ]);
    }
}
