<?php

namespace Database\Factories;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityLogFactory extends Factory
{
    protected $model = ActivityLog::class;

    public function definition(): array
    {
        $subject = $this->faker->randomElement([
            User::inRandomOrder()->first(),
            Employee::inRandomOrder()->first(),
            null,
        ]);

        $actor = User::inRandomOrder()->first();

        return [
            'actor_user_id' => $actor?->id,
            'action' => $this->faker->randomElement(['created', 'updated', 'deleted', 'viewed']),
            'subject_type' => $subject ? $subject::class : User::class,
            'subject_id' => $subject?->id ?? User::query()->value('id') ?? 1,
            'properties' => json_encode([
                'ip_address' => $this->faker->ipv4,
                'user_agent' => $this->faker->userAgent,
            ]),
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
