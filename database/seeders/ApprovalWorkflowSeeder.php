<?php

namespace Database\Seeders;

use App\Models\ApprovalWorkflow;
use Illuminate\Database\Seeder;

class ApprovalWorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApprovalWorkflow::firstOrCreate(
            ['name' => 'Leave Request Approval'],
            ['entity_type' => 'leave_request', 'description' => 'Workflow for approving employee leave requests.', 'is_active' => true]
        );
        ApprovalWorkflow::firstOrCreate(
            ['name' => 'Expense Report Approval'],
            ['entity_type' => 'expense_report', 'description' => 'Workflow for approving employee expense reports.', 'is_active' => true]
        );
        ApprovalWorkflow::firstOrCreate(
            ['name' => 'Purchase Order Approval'],
            ['entity_type' => 'purchase_order', 'description' => 'Workflow for approving purchase orders.', 'is_active' => true]
        );

        ApprovalWorkflow::factory()->count(5)->create();

        $this->command->info('Approval Workflows seeded.');
    }
}
