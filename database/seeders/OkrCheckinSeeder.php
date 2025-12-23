<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\OkrCheckin;
use App\Models\OkrKeyResult;
use Illuminate\Database\Seeder;

class OkrCheckinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keyResults = OkrKeyResult::all();
        $employees = Employee::all();

        if ($keyResults->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No OKR key results or employees found, skipping OKR checkin seeding.');
            return;
        }

        foreach ($keyResults as $keyResult) {
            OkrCheckin::create([
                'key_result_id' => $keyResult->id,
                'employee_id' => $employees->random()->id,
                'value' => $keyResult->current_value + (rand(1, 5) * ($keyResult->unit == 'USD' ? 1000 : 1)),
                'notes' => 'Weekly progress update.',
                'checked_in_at' => now()->subDays(rand(1, 7)),
            ]);
        }
    }
}
