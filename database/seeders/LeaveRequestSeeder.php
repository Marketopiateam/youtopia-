<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();

        if ($employees->isEmpty() || $leaveTypes->isEmpty()) {
            $this->command->info('No employees or leave types found, skipping leave request seeding.');
            return;
        }

        foreach ($employees as $employee) {
            LeaveRequest::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveTypes->random()->id,
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(7),
                'reason' => 'Annual vacation.',
                'status' => 'pending',
                'approver_employee_id' => $employee->manager_employee_id ?? $employees->random()->id,
            ]);
        }
    }
}
