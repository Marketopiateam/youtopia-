<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure users and employees exist for relating activity logs
        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        // Create 100 activity logs
        ActivityLog::factory()->count(100)->create();

        $this->command->info('Activity Logs seeded.');
    }
}
