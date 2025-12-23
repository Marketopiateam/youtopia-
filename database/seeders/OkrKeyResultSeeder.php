<?php

namespace Database\Seeders;

use App\Enums\OKRStatus;
use App\Models\OkrKeyResult;
use App\Models\OkrObjective;
use Illuminate\Database\Seeder;

class OkrKeyResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objectives = OkrObjective::all();

        if ($objectives->isEmpty()) {
            $this->command->info('No OKR objectives found, skipping OKR key result seeding.');
            return;
        }

        foreach ($objectives as $objective) {
            OkrKeyResult::create([
                'objective_id' => $objective->id,
                'title' => 'Achieve 90% customer satisfaction score',
                'target_value' => 90.00,
                'current_value' => 75.00,
                'unit' => '%',
                'status' => OKRStatus::Active,
            ]);

            OkrKeyResult::create([
                'objective_id' => $objective->id,
                'title' => 'Increase monthly recurring revenue (MRR) to $1M',
                'target_value' => 1000000.00,
                'current_value' => 750000.00,
                'unit' => 'USD',
                'status' => OKRStatus::Active,
            ]);
        }
    }
}
