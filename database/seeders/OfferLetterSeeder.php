<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use App\Models\OfferLetter;
use Illuminate\Database\Seeder;

class OfferLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobApplications = JobApplication::all();

        if ($jobApplications->isEmpty()) {
            $this->command->info('No job applications found, skipping offer letter seeding.');
            return;
        }

        foreach ($jobApplications as $application) {
            OfferLetter::create([
                'application_id' => $application->id,
                'offered_position' => $application->jobPost->title,
                'salary_amount' => 60000.00,
                'start_date' => now()->addDays(30),
                'status' => 'sent',
                'sent_at' => now(),
                'terms' => 'Standard employment terms apply.',
            ]);
        }
    }
}
