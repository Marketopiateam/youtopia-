<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 conversations
        Conversation::factory()->count(20)->create();

        $this->command->info('Conversations seeded.');
    }
}
