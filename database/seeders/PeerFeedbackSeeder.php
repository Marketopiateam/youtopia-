<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\PeerFeedback;
use Illuminate\Database\Seeder;

class PeerFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->count() < 2) {
            $this->command->info('Less than 2 employees found, skipping peer feedback seeding.');
            return;
        }

        foreach ($employees as $employee) {
            $reviewer = $employees->where('id', '!=', $employee->id)->random();

            PeerFeedback::create([
                'employee_id' => $employee->id,
                'reviewer_employee_id' => $reviewer->id,
                'feedback_text' => 'Great team player, always willing to help and contributes positively to discussions.',
                'rating' => rand(30, 50) / 10, // Rating between 3.0 and 5.0
                'is_anonymous' => false,
                'submitted_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
