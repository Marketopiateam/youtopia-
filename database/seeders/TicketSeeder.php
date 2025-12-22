<?php

namespace Database\Seeders;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Employee;
use App\Models\EmployeeProfile;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $ticketTypes = TicketType::all();

        // Get users who have employee records with managers assigned
        $users = User::whereHas('employee', function ($query) {
            $query->whereNotNull('manager_employee_id');
        })->get();

        if ($ticketTypes->isEmpty() || $users->isEmpty()) {
            $this->command->warn('No ticket types or users with employees having managers found, skipping TicketSeeder.');
            return;
        }

        foreach ($users->take(5) as $user) {
            Ticket::create([
                'user_id' => $user->id,
                'ticket_type_id' => $ticketTypes->random()->id,
                'reason' => fake()->sentence(),
                'priority' => collect(TicketPriority::cases())->random(),
                'expected_from' => now()->addDays(rand(1, 30)),
                'expected_to' => now()->addDays(rand(31, 60)),
                'amount' => rand(100, 1000),
                'status' => TicketStatus::PendingManager,
            ]);
        }
    }
}

