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
        $meetings = Meeting::all();

        if ($meetings->isEmpty()) {
            $this->command->info('No meetings found, skipping meeting agenda item seeding.');
            return;
        }

        foreach ($meetings as $meeting) {
            MeetingAgendaItem::create([
                'meeting_id' => $meeting->id,
                'title' => 'Review Q4 Performance',
                'description' => 'Discussion on key metrics and achievements.',
                'order' => 1,
                'duration_minutes' => 30,
            ]);

            MeetingAgendaItem::create([
                'meeting_id' => $meeting->id,
                'title' => 'Planning for Q1 Initiatives',
                'description' => 'Outline new projects and resource allocation.',
                'order' => 2,
                'duration_minutes' => 45,
            ]);
        }
    }
}
