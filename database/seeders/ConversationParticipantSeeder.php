<?php

namespace Database\Seeders;

use App\Models\ConversationParticipant;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Seeder;

class ConversationParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure conversations and users exist
        if (Conversation::count() === 0) {
            $this->call(ConversationSeeder::class);
        }
        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }

        $conversations = Conversation::all();
        $users = User::all();

        foreach ($conversations as $conversation) {
            // Add a random number of participants to each conversation
            $participantsCount = rand(2, min(5, $users->count())); // At least 2 participants, max 5 or total users

            // Ensure unique users per conversation
            $selectedUsers = $users->shuffle()->take($participantsCount);

            foreach ($selectedUsers as $user) {
                ConversationParticipant::firstOrCreate(
                    [
                        'conversation_id' => $conversation->id,
                        'user_id' => $user->id,
                    ]
                );
            }
        }

        $this->command->info('Conversation Participants seeded.');
    }
}
