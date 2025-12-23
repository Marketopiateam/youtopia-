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
        $jobPosts = JobPost::all();

        if ($jobPosts->isEmpty()) {
            $this->command->info('No job posts found, skipping job application seeding.');
            return;
        }

        foreach ($jobPosts as $jobPost) {
            JobApplication::create([
                'job_post_id' => $jobPost->id,
                'applicant_name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '0123456789',
                'status' => 'applied',
            ]);

            JobApplication::create([
                'job_post_id' => $jobPost->id,
                'applicant_name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '0987654321',
                'status' => 'screening',
            ]);
        }
    }
}
