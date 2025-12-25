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
        if (Meeting::count() === 0) {
            $this->call(MeetingSeeder::class);
        }
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        $meetings = Meeting::all();
        $employees = Employee::all();

        foreach ($meetings as $meeting) {
            // Create 1-3 action items per meeting
            for ($i = 0; $i < rand(1, 3); $i++) {
                MeetingActionItem::factory()->make()->each(function ($item) use ($meeting, $employees) {
                    $item->meeting_id = $meeting->id;
                    $item->assigned_to_employee_id = $employees->random()->id;
                    $item->save();
                });
            }
        }

        $this->command->info('Meeting Action Items seeded.');
    }
}
