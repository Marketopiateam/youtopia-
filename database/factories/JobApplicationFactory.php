<?php

namespace Database\Factories;

use App\Enums\ApplicationStatus;
use App\Models\JobApplication;
use App\Models\JobPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicationFactory extends Factory
{
    protected $model = JobApplication::class;

    public function definition(): array
    {
        return [
            'job_post_id' => JobPost::factory(),
            'applicant_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'resume_path' => 'resumes/' . $this->faker->uuid . '.pdf',
            'cover_letter' => $this->faker->boolean(70) ? $this->faker->paragraph : null,
            'status' => $this->faker->randomElement(ApplicationStatus::cases()),
            'applied_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
