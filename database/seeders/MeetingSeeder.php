<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure employees exist
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        // Create 20 meetings
        $employees = Employee::all();
        Meeting::factory()->count(20)->make()->each(function ($meeting) use ($employees) {
            $meeting->organizer_employee_id = $employees->random()->id;
            $meeting->save();
        });

        $this->command->info('Meetings seeded.');
    }
}
