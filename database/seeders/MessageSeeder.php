<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Employee;
use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conversations = Conversation::all();
        $employees = Employee::all();

        if ($conversations->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No conversations or employees found, skipping message seeding.');
            return;
        }

        foreach ($conversations as $conversation) {
            Message::create([
                'conversation_id' => $conversation->id,
                'sender_employee_id' => $employees->random()->id,
                'content' => 'Hello team, just a quick update on the project.',
            ]);

            Message::create([
                'conversation_id' => $conversation->id,
                'sender_employee_id' => $employees->random()->id,
                'content' => 'Acknowledged. I will review the updates.',
            ]);
        }
    }
}
