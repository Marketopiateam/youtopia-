<?php

namespace Database\Seeders;

use App\Enums\MeetingStatus;
use App\Models\Employee;
use App\Models\Meeting;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping meeting seeding.');
            return;
        }

        Meeting::create([
            'title' => 'Weekly Team Sync',
            'description' => 'Discuss weekly progress and upcoming tasks.',
            'scheduled_at' => now()->addDays(2)->setHour(10)->setMinute(0),
            'duration_minutes' => 60,
            'location' => 'Conference Room A',
            'organizer_employee_id' => $employees->random()->id,
            'status' => MeetingStatus::SCHEDULED,
        ]);

        Meeting::create([
            'title' => 'Project Alpha Kick-off',
            'description' => 'Initiate Project Alpha with all stakeholders.',
            'scheduled_at' => now()->addDays(5)->setHour(14)->setMinute(30),
            'duration_minutes' => 90,
            'location' => 'Online (Zoom)',
            'meeting_link' => 'https://zoom.us/j/1234567890',
            'organizer_employee_id' => $employees->random()->id,
            'status' => MeetingStatus::SCHEDULED,
        ]);
    }
}
