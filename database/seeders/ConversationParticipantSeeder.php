<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Conversation;
use App\Models\User;


class ConversationParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conversations = Conversation::all();
        $users = User::all();

        if ($conversations->isNotEmpty() && $users->count() >= 2) {
            foreach ($conversations as $conversation) {
                DB::table('conversation_participants')->insert([
                    'conversation_id' => $conversation->id,
                    'user_id' => $users->random()->id,
                ]);
                DB::table('conversation_participants')->insert([
                    'conversation_id' => $conversation->id,
                    'user_id' => $users->random()->id,
                ]);
            }
        }
    }
}
