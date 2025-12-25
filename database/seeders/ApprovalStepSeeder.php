<?php

namespace Database\Seeders;

use App\Models\ApprovalStep;
use App\Models\ApprovalWorkflow;
use App\Models\Employee;
use App\Enums\ApprovalApproverType;
use Illuminate\Database\Seeder;

class ApprovalStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ApprovalWorkflow::count() === 0) {
            $this->call(ApprovalWorkflowSeeder::class);
        }
        $employees = Employee::all();
        $faker = \Faker\Factory::create();
        $workflows = ApprovalWorkflow::all();

        foreach ($workflows as $workflow) {
            for ($i = 1; $i <= rand(2, 4); $i++) {
                $approverType = $faker->randomElement(ApprovalApproverType::cases());
                $approverRole = null;
                $approverEmployeeId = null;

                if ($approverType === ApprovalApproverType::Role) {
                    $approverRole = $faker->randomElement(['manager', 'hr', 'admin']);
                } elseif ($approverType === ApprovalApproverType::Employee && $employees->isNotEmpty()) {
                    $approverEmployeeId = $employees->random()->id;
                }

                ApprovalStep::firstOrCreate(
                    [
                        'workflow_id' => $workflow->id,
                        'step_order' => $i,
                    ],
                    [
                        'approver_type' => $approverType,
                        'approver_role' => $approverRole,
                        'approver_employee_id' => $approverEmployeeId,
                        'is_required' => $faker->boolean(80),
                    ]
                );
            }
        }

        $this->command->info('Approval Steps seeded.');
    }
}
