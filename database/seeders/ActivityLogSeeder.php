<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found, skipping activity log seeding.');
            return;
        }

        ActivityLog::create([
            'actor_user_id' => $users->random()->id,
            'action' => 'created',
            'subject_type' => 'App\Models\Ticket',
            'subject_id' => 1,
            'properties' => json_encode(['attributes' => ['status' => 'open']]),
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Seeder',
        ]);

        ActivityLog::create([
            'actor_user_id' => $users->random()->id,
            'action' => 'updated',
            'subject_type' => 'App\Models\Ticket',
            'subject_id' => 1,
            'properties' => json_encode(['old' => ['status' => 'open'], 'attributes' => ['status' => 'closed']]),
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Seeder',
        ]);
    }
}
