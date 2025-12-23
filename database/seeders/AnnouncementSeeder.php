<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found, skipping announcement seeding.');
            return;
        }

        Announcement::create([
            'title' => 'Welcome to Youtopia!',
            'body' => 'We are excited to have you on board. This is a company-wide announcement.',
            'created_by_user_id' => $users->random()->id,
            'target_scope' => 'company',
            'publish_at' => now(),
            'is_active' => true,
        ]);

        Announcement::create([
            'title' => 'New Feature: Ticket Management',
            'body' => 'You can now submit and track tickets for various issues.',
            'created_by_user_id' => $users->random()->id,
            'target_scope' => 'company',
            'publish_at' => now(),
            'is_active' => true,
        ]);
    }
}
