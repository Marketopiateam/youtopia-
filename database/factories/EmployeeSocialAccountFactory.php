<?php

namespace Database\Factories;

use App\Models\EmployeeSocialAccount;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeSocialAccountFactory extends Factory
{
    protected $model = EmployeeSocialAccount::class;

    public function definition(): array
    {
        $platform = $this->faker->randomElement(['linkedin', 'github', 'twitter', 'gmail', 'instagram', 'other']);
        $username = $this->faker->userName;

        return [
            'employee_id' => Employee::factory(),
            'platform' => $platform,
            'username' => $username,
            'email' => $this->faker->boolean(50) ? $this->faker->safeEmail : null,
            'url' => $this->faker->boolean(70) ? "https://www.{$platform}.com/{$username}" : null,
            'password_hint' => $this->faker->boolean(20) ? $this->faker->word : null,
            'notes' => $this->faker->boolean(20) ? $this->faker->sentence : null,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
