<?php

namespace Database\Seeders;

use App\Enums\OKRStatus;
use App\Models\OkrCycle;
use Illuminate\Database\Seeder;

class OkrCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OkrCycle::create([
            'name' => 'Q1 2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-03-31',
            'status' => OKRStatus::IN_PROGRESS,
        ]);

        OkrCycle::create([
            'name' => 'Q2 2026',
            'start_date' => '2026-04-01',
            'end_date' => '2026-06-30',
            'status' => OKRStatus::DRAFT,
        ]);
    }
}
