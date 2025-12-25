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
        if (ApprovalRequest::count() === 0) {
            $this->call(ApprovalRequestSeeder::class);
        }
        if (ApprovalStep::count() === 0) {
            $this->call(ApprovalStepSeeder::class);
        }
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        $approvalRequests = ApprovalRequest::all();
        $employees = Employee::all();
        $steps = ApprovalStep::all();

        foreach ($approvalRequests as $request) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                ApprovalAction::factory()->make()->each(function ($action) use ($request, $employees, $steps) {
                    $action->approval_request_id = $request->id;
                    $action->approver_employee_id = $employees->random()->id;
                    $action->step_id = $steps->random()->id;
                    $action->save();
                });
            }
        }

        $this->command->info('Approval Actions seeded.');
    }
}
