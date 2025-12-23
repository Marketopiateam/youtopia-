<?php

namespace Database\Seeders;

use App\Models\Interview;
use App\Models\JobApplication;
use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobApplications = JobApplication::all();

        if ($jobApplications->isEmpty()) {
            $this->command->info('No job applications found, skipping interview seeding.');
            return;
        }

        foreach ($jobApplications as $application) {
            Interview::create([
                'application_id' => $application->id,
                'scheduled_at' => now()->addDays(rand(1, 10)),
                'location' => 'Online (Google Meet)',
                'interview_type' => 'video',
                'status' => 'scheduled',
            ]);
        }
    }
}
