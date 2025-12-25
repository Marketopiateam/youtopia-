<?php

namespace Database\Seeders;

use App\Models\ApprovalRequest;
use App\Models\ApprovalStep;
use App\Models\ApprovalWorkflow;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class ApprovalRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ApprovalWorkflow::count() === 0) {
            $this->call(ApprovalWorkflowSeeder::class);
        }
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }
        if (ApprovalStep::count() === 0) {
            $this->call(ApprovalStepSeeder::class);
        }

        $workflows = ApprovalWorkflow::with('steps')->get();
        $employees = Employee::all();

        ApprovalRequest::factory()->count(30)->make()->each(function ($request) use ($workflows, $employees) {
            $workflow = $workflows->random();
            $employee = $employees->random();

            $request->workflow_id = $workflow->id;
            $request->requester_employee_id = $employee->id;

            $firstStep = $workflow->steps()->orderBy('step_order')->first();
            $request->current_step = $firstStep?->step_order ?? 1;

            $request->save();
        });

        $this->command->info('Approval Requests seeded.');
    }
}
