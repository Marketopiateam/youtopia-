<?php

namespace Database\Factories;

use App\Enums\JobPostStatus;
use App\Models\Department;
use App\Models\Employee;
use App\Models\JobPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobPostFactory extends Factory
{
    protected $model = JobPost::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(JobPostStatus::cases());
        $publishedAt = $status->value === 'published'
            ? $this->faker->dateTimeBetween('-6 months', 'now')
            : null;
        $expiresAt = $publishedAt ? (clone $publishedAt)->modify('+' . $this->faker->numberBetween(7, 60) . ' days') : null;

        return [
            'department_id' => Department::factory(),
            'created_by_employee_id' => Employee::factory(),
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraphs(3, true),
            'requirements' => $this->faker->paragraphs(2, true),
            'url' => $this->faker->boolean(40) ? $this->faker->url : null,
            'status' => $status,
            'published_at' => $publishedAt,
            'expires_at' => $expiresAt,
        ];
    }
}
