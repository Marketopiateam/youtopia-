<?php

namespace Database\Factories;

use App\Models\TicketType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketTypeFactory extends Factory
{
    protected $model = TicketType::class;

    public function definition(): array
    {
        return [
            'name' => 'Ticket Type ' . strtoupper($this->faker->unique()->bothify('TT-###')),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
