<?php

namespace Database\Seeders;

use App\Models\ApprovalRequest;
use App\Models\ApprovalWorkflow;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class ApprovalRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaveWorkflow = ApprovalWorkflow::where('entity_type', 'leave_request')->first();
        $ticketWorkflow = ApprovalWorkflow::where('entity_type', 'ticket')->first();
        $employees = Employee::all();
        $leaveRequests = LeaveRequest::all();
        $tickets = Ticket::all();

        if ($leaveWorkflow && $employees->isNotEmpty() && $leaveRequests->isNotEmpty()) {
            ApprovalRequest::create([
                'workflow_id' => $leaveWorkflow->id,
                'requestable_type' => 'App\Models\LeaveRequest',
                'requestable_id' => $leaveRequests->random()->id,
                'requester_employee_id' => $employees->random()->id,
                'status' => 'pending',
            ]);
        }

        if ($ticketWorkflow && $employees->isNotEmpty() && $tickets->isNotEmpty()) {
            ApprovalRequest::create([
                'workflow_id' => $ticketWorkflow->id,
                'requestable_type' => 'App\Models\Ticket',
                'requestable_id' => $tickets->random()->id,
                'requester_employee_id' => $employees->random()->id,
                'status' => 'approved',
                'completed_at' => now(),
            ]);
        }
    }
}
