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
        if (JobApplication::count() === 0) {
            $this->call(JobApplicationSeeder::class);
        }

        $jobApplications = JobApplication::all();

        Interview::factory()->count(40)->make()->each(function ($interview) use ($jobApplications) {
            $interview->application_id = $jobApplications->random()->id;
            $interview->save();
        });

        $this->command->info('Interviews seeded.');
    }
}
