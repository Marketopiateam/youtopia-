<?php

namespace Database\Factories;

use App\Enums\AudienceType;
use App\Models\Announcement;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition(): array
    {
        $scope = $this->faker->randomElement([
            AudienceType::Company,
            AudienceType::Department,
        ]);

        return [
            'title' => $this->faker->sentence(5),
            'body' => $this->faker->paragraphs(3, true),
            'created_by_user_id' => User::factory(),
            'target_scope' => $scope,
            'target_scope_id' => $scope === AudienceType::Department
                ? Department::inRandomOrder()->value('id')
                : null,
            'publish_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'expires_at' => $this->faker->boolean(70) ? $this->faker->dateTimeBetween('now', '+1 year') : null,
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
