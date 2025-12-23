<?php

namespace App\Listeners;

use App\Events\LeaveRequestSubmitted;
use App\Models\ApprovalRequest;
use App\Models\ApprovalWorkflow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateApprovalRequest implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(LeaveRequestSubmitted $event): void
    {
        $leaveRequest = $event->leaveRequest;

        // Find appropriate workflow for leave requests in employee's department
        $workflow = ApprovalWorkflow::where('entity_type', 'leave_request')
                                   ->where(function ($query) use ($leaveRequest) {
                                       $query->whereNull('department_id')
                                            ->orWhere('department_id', $leaveRequest->employee->department_id);
                                   })
                                   ->first();

        if (!$workflow) {
            // Create default workflow if none exists
            $workflow = ApprovalWorkflow::create([
                'name' => 'Default Leave Approval',
                'entity_type' => 'leave_request',
                'department_id' => $leaveRequest->employee->department_id,
                'is_active' => true,
            ]);

            // Add default steps: Manager -> HR
            $workflow->steps()->create([
                'step_order' => 1,
                'approver_role' => 'manager',
                'is_required' => true,
            ]);

            $workflow->steps()->create([
                'step_order' => 2,
                'approver_role' => 'hr',
                'is_required' => true,
            ]);
        }

        // Create approval request
        ApprovalRequest::create([
            'workflow_id' => $workflow->id,
            'requestable_type' => 'App\\Models\\LeaveRequest',
            'requestable_id' => $leaveRequest->id,
            'requester_employee_id' => $leaveRequest->employee_id,
            'current_step' => 1,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);
    }
}
