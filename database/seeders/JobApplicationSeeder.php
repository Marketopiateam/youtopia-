<?php

namespace Database\Seeders;

use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Database\Seeder;

class JobApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure job posts exist
        if (JobPost::count() === 0) {
            $this->call(JobPostSeeder::class);
        }

        $jobPosts = JobPost::all();

        // Create 50 job applications
        JobApplication::factory()->count(50)->make()->each(function ($application) use ($jobPosts) {
            $application->job_post_id = $jobPosts->random()->id;
            $application->save();
        });

        $this->command->info('Job Applications seeded.');
    }
}