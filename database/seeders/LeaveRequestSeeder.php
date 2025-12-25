<?php

namespace Database\Seeders;

use App\Models\LeaveRequest;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure necessary data exists
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }
        if (LeaveType::count() === 0) {
            $this->call(LeaveTypeSeeder::class);
        }
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();
        $approverEmployees = Employee::whereHas('user.roles', function ($query) {
            $query->whereIn('name', ['admin', 'hr', 'manager']);
        })->get();

        if ($approverEmployees->isEmpty()) {
            $approverEmployees = $employees;
        }

        // Create 50 leave requests
        LeaveRequest::factory()->count(50)->make()->each(function ($request) use ($employees, $leaveTypes, $approverEmployees) {
            $request->employee_id = $employees->random()->id;
            $request->leave_type_id = $leaveTypes->random()->id;
            if ($approverEmployees->isNotEmpty() && ($request->status == \App\Enums\LeaveStatus::Approved || $request->status == \App\Enums\LeaveStatus::Rejected)) {
                $request->approver_employee_id = $approverEmployees->random()->id;
            }
            $request->save();
        });

        $this->command->info('Leave Requests seeded.');
    }
}
