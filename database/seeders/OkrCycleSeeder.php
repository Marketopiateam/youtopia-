<?php

namespace Database\Seeders;

use App\Models\OkrCycle;
use Illuminate\Database\Seeder;

class OkrCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 OKR cycles
        OkrCycle::factory()->count(5)->create();

        $this->command->info('OKR Cycles seeded.');
    }
}
