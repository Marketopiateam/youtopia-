<?php

namespace Database\Seeders;

use App\Models\ApprovalAction;
use App\Models\ApprovalRequest;
use App\Models\ApprovalStep;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class ApprovalActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approvalRequest = ApprovalRequest::first();
        $approvalStep = ApprovalStep::first();
        $employee = Employee::first();

        if ($approvalRequest && $approvalStep && $employee) {
            ApprovalAction::create([
                'approval_request_id' => $approvalRequest->id,
                'step_id' => $approvalStep->id,
                'approver_employee_id' => $employee->id,
                'action' => 'approved',
                'notes' => 'This is an automatic approval from the seeder.',
                'acted_at' => now(),
            ]);
        }
    }
}
