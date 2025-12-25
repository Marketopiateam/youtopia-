<?php

namespace Database\Factories;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        $from = $this->faker->dateTimeBetween('+1 day', '+1 week');
        $to = (clone $from)->modify('+3 days');

        return [
            'user_id' => User::factory(),
            'ticket_type_id' => TicketType::factory(),
            'reason' => $this->faker->sentence(),
            'priority' => $this->faker->randomElement(TicketPriority::cases()),
            'expected_from' => $from->format('Y-m-d'),
            'expected_to' => $to->format('Y-m-d'),
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'attachments' => [],
            'status' => $this->faker->randomElement(TicketStatus::cases()),
            'submitted_at' => now(),
            'manager_approved' => null,
            'manager_reason' => null,
            'manager_action_at' => null,
            'manager_actor_email' => null,
            'hr_approved' => null,
            'hr_reason' => null,
            'hr_action_at' => null,
            'hr_actor_email' => null,
        ];
    }
}
