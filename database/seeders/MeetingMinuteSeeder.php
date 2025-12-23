<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Meeting;
use App\Models\MeetingMinute;
use Illuminate\Database\Seeder;

class MeetingMinuteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meetings = Meeting::all();
        $employees = Employee::all();

        if ($meetings->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No meetings or employees found, skipping meeting minute seeding.');
            return;
        }

        foreach ($meetings as $meeting) {
            MeetingMinute::create([
                'meeting_id' => $meeting->id,
                'content' => 'Key discussion points included Q4 performance review and planning for Q1 initiatives. Action items were assigned to relevant team members with clear deadlines. Overall, the meeting was productive and achieved its objectives.',
                'recorded_by_employee_id' => $employees->random()->id,
            ]);
        }
    }
}
