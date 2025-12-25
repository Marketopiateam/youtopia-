<?php

namespace Database\Factories;

use App\Enums\AudienceType;
use App\Enums\WorklifePostType;
use App\Models\Employee;
use App\Models\WorklifePost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorklifePost>
 */
class WorklifePostFactory extends Factory
{
    protected $model = WorklifePost::class;

    public function definition(): array
    {
        return [
            'author_employee_id' => Employee::factory(),
            'source_type' => null,
            'source_id' => null,
            'post_type' => WorklifePostType::General,
            'content' => $this->faker->paragraph(),
            'audience_type' => AudienceType::Company,
            'audience_id' => null,
            'is_pinned' => $this->faker->boolean(10),
            'published_at' => now(),
        ];
    }
}
