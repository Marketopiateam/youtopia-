<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Meeting;
use App\Models\MeetingActionItem;
use Illuminate\Database\Seeder;

class MeetingActionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meetings = Meeting::all();
        $employees = Employee::all();

        if ($meetings->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No meetings or employees found, skipping meeting action item seeding.');
            return;
        }

        foreach ($meetings as $meeting) {
            MeetingActionItem::create([
                'meeting_id' => $meeting->id,
                'title' => 'Prepare Q1 Sales Report',
                'description' => 'Gather data and generate report for the next meeting.',
                'assigned_to_employee_id' => $employees->random()->id,
                'due_date' => now()->addDays(7),
                'status' => 'pending',
            ]);

            MeetingActionItem::create([
                'meeting_id' => $meeting->id,
                'title' => 'Follow up with Project Alpha team',
                'description' => 'Check progress and address any blockers.',
                'assigned_to_employee_id' => $employees->random()->id,
                'due_date' => now()->addDays(5),
                'status' => 'in_progress',
            ]);
        }
    }
}
