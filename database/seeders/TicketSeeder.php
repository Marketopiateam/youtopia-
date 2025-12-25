<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }
        if (TicketType::count() === 0) {
            $this->call(TicketTypeSeeder::class);
        }

        $users = User::all();
        $ticketTypes = TicketType::all();

        Ticket::factory()->count(50)->make()->each(function ($ticket) use ($users, $ticketTypes) {
            $ticket->user_id = $users->random()->id;
            $ticket->ticket_type_id = $ticketTypes->random()->id;
            $ticket->save();
        });

        $this->command->info('Tickets seeded.');
    }
}
