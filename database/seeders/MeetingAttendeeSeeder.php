<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Meeting;
use App\Models\MeetingAttendee;
use Illuminate\Database\Seeder;

class MeetingAttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meetings = Meeting::all();
        $employees = Employee::all();

        if ($meetings->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No meetings or employees found, skipping meeting attendee seeding.');
            return;
        }

        foreach ($meetings as $meeting) {
            $attendees = $employees->random(min(rand(1, $employees->count()), 3)); // 1 to 3 random attendees
            foreach ($attendees as $attendee) {
                // Check if the organizer is also an attendee, to avoid unique constraint violation if they are picked randomly
                if ($meeting->organizer_employee_id === $attendee->id) {
                    continue;
                }

                MeetingAttendee::firstOrCreate(
                    [
                        'meeting_id' => $meeting->id,
                        'employee_id' => $attendee->id,
                    ],
                    [
                        'attendance_status' => 'accepted',
                    ]
                );
            }

            // Ensure the organizer is also an attendee
            MeetingAttendee::firstOrCreate(
                [
                    'meeting_id' => $meeting->id,
                    'employee_id' => $meeting->organizer_employee_id,
                ],
                [
                    'attendance_status' => 'attended',
                ]
            );
        }
    }
}
