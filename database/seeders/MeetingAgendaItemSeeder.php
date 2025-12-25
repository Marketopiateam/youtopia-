<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\MeetingAgendaItem;
use Illuminate\Database\Seeder;

class MeetingAgendaItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Meeting::count() === 0) {
            $this->call(MeetingSeeder::class);
        }

        $meetings = Meeting::all();

        foreach ($meetings as $meeting) {
            for ($i = 0; $i < rand(3, 7); $i++) {
                MeetingAgendaItem::factory()->make()->each(function ($item) use ($meeting, $i) {
                    $item->meeting_id = $meeting->id;
                    $item->order = $i + 1;
                    $item->save();
                });
            }
        }

        $this->command->info('Meeting Agenda Items seeded.');
    }
}
